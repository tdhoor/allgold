<template>
    <div class="app-inner">
        <Header />
        <Modal
            :modalName="modal.form.name"
            :items="modal.form.items"
            :title="modal.form.title"
        />
        <ModalMessage
            :modalName="modal.message.name"
            :title="modal.message.title"
            :message="modal.message.message"
        />
        <div class="row app-container">
            <div class="col-6 container-products">
                <div class="card">
                    <div class="card-header">Verfügbare Titel</div>
                    <div class="card-body">
                        <Table :items="products" :btnAction="true" />
                    </div>
                    <div class="card-footer text-muted">
                        <button class="btn btn-primary">Aktualisieren</button>
                    </div>
                </div>
            </div>
            <div class="col-6 container-shoppingcar">
                <div class="card">
                    <div class="card-header">Shoppingcar</div>
                    <div class="card-body">
                        <Table :items="shoppingcar" :btnDelete="true" />
                    </div>
                    <div
                        class="card-footer text-muted d-flex justify-content-between"
                    >
                        <div>
                            <button class="btn btn-primary">Abschließen</button>
                            <button class="btn btn-warning">
                                Zurücksetzten
                            </button>
                        </div>
                        <div class="d-flex align-items-center">
                            <span>Totaler Preis: &#160; &#160;</span>
                            <span class="totalprice">33.33€</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// components
import Header from '../components/Header'
import Table from '../components/Table'
import Modal from '../components/Modal'
import ModalMessage from '../components/ModalMessage'
// services
import ProductService from '../services/ProductService.js'
import SaleService from '../services/SaleService.js'
import ShoppingcarService from '../services/ShoppingcarService.js'
import InventoryService from '../services/InventoryService.js'
// utils
import Product from '../utils/Product'
import Inventory from '../utils/Inventory'

export default {
    name: 'Verkauf',
    components: {
        Header,
        Table,
        Modal,
        ModalMessage
    },

    computed: {},
    data() {
        return {
            products: [],
            inventories: [],
            shoppingcar: [],
            stationid: null,
            modal: {
                form: {
                    name: 'modalLogin',
                    title: 'Login:',
                    method: null,
                    items: {}
                },
                message: {
                    name: 'modalError',
                    title: 'Error',
                    message: 'No search result!'
                }
            }
        }
    },
    methods: {
        loadInventoryFromDb: function (id) {
            InventoryService.getInventory(id).then(response => {
                response.forEach(element => {
                    let product = new Product(element)
                    let inventory = new Inventory(element)

                    this.inventories.push(inventory)

                    if (inventory.currentAmount !== 0) {
                        this.products.push({
                            productId: product.productId,
                            price: product.price,
                            name: product.name,
                            currentAmount: inventory.currentAmount,
                            targetAmount: inventory.targetAmount
                        })
                    }
                })
            })
        },
        updateInventoryInDb: function (inventory) {
            InventoryService.update(inventory.toJSON())
                .then(response => {
                    this.updateEntry(new Station(response))
                    this.hideModalForm()
                    this.showModalMessage(
                        'Info',
                        'Successfully updated inventory with id: ' +
                            response.inventoryId
                    )
                })
                .catch(error => {
                    this.deleteAllLocalStations()
                    this.showModalMessage('Error', error)
                })
        },
        // Btns action
        clickTableAction: function (product) {
            let pro = this.getProductById(product.productId)
            this.shoppingcar.push(JSON.parse(JSON.stringify(product)))
        },
        // Local
        getProductById(id) {
            const product = this.products.filter(el => el.productId === id)
            return product
        },
        /**
         * Modal form methods
         */
        handleModalSave: function (station) {
            this.stationid = station.stationPrimaryKey
            this.loadInventoryFromDb(this.stationid)
            this.hideModalForm()
        },
        updateModalForm: function (method, title, items) {
            this.modal.form.method = method
            this.modal.form.title = title
            this.modal.form.items = items
        },
        showModalForm: function (method, title, items) {
            this.updateModalForm(method, title, items)
            $('#' + this.modal.form.name).modal('show')
        },
        hideModalForm: function () {
            $('#' + this.modal.form.name).modal('hide')
        }
    },
    mounted() {
        this.showModalForm('null', 'Login with station id:', {
            stationPrimaryKey: ''
        })
    },
    destroyed() {
        this.stationid = null
    }
}
</script>
<style>
.app-container {
    height: calc(100% - 80px); /** minus navbar */
    padding: 20px;
}
.card,
.container-products,
.container-shoppingcar {
    height: 100%;
}
</style>
