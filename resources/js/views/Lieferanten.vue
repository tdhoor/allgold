<template>
    <div>
        <Header v-bind:subPages="navItems" />
        <Subnav :btnRefresh="true" :title="'Neue Lieferung erstellen'" />
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
            <div class="col-12">
                <Table
                    :items="refillPrototypes"
                    :modalName="'editRefill'"
                    :btnAction="true"
                />
            </div>
        </div>
    </div>
</template>

<script>
// components
import Header from '../components/Header'
import Table from '../components/Table'
import Modal from '../components/Modal'
import Subnav from '../components/Subnav'
import ModalMessage from '../components/ModalMessage'
// Models
import Refill from '../utils/Refill'
import Inventory from '../utils/Inventory'
import Product from '../utils/Product'
import Prototype from '../utils/Prototype'
// Services
import RefillService from '../services/RefillService'
import InventoryService from '../services/InventoryService'
import ProductService from '../services/ProductService'
// Helpers
import Helper from '../helper/Helper'
// Constants
const METHOD_POST = 'methodPost'
const METHOD_UPDATE = 'methodUpdate'

export default {
    components: {
        Header,
        Table,
        Modal,
        Subnav,
        ModalMessage
    },
    computed: {},
    data() {
        return {
            refills: [],
            products: [],
            inventories: [],
            refillPrototypes: [],
            navItems: [
                {
                    url: 'http://www.allgold.de/lieferanten',
                    name: 'Lieferanten'
                },
                {
                    url: 'http://www.allgold.de/lieferanten/refill',
                    name: 'Refills'
                }
            ],
            modal: {
                form: {
                    name: 'modalEdit',
                    title: 'Refill Hinzufügen:',
                    method: METHOD_POST,
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
        /**
         * Table methods
         */
        clickTableAction: function (refillPrototype) {
            this.showModalForm(
                METHOD_UPDATE,
                'Bearbeiten',
                refillPrototype.toModalJSON()
            )
        },
        /**
         * Handle subnav methods
         */
        handleRefresh: function () {
            this.resetAll()
            this.loadData()
        },
        /**
         * DB methods
         */
        dbRefillAdd: function (refill) {
            return new Promise((resolve, reject) => {
                RefillService.store(refill)
                    .then(response => {
                        if (response.status === 200) {
                            resolve(response.data[0])
                        }
                    })
                    .catch(error => this.showModalMessage('Error', error))
            })
        },
        dbInventoryUpdate: function (inventory) {
            return new Promise((resolve, reject) => {
                InventoryService.update(inventory)
                    .then(response => {
                        resolve(response)
                    })
                    .catch(error => {
                        this.showModalMessage('Error', error)
                    })
            })
        },
        dbProductUpdate: function (product) {
            return new Promise((resolve, reject) => {
                ProductService.update(product)
                    .then(response => {
                        resolve(response)
                    })
                    .catch(error => {
                        this.showModalMessage('Error', error)
                    })
            })
        },
        /**
         * Local storage
         */
        localInventoriesGet(id) {
            const inventory = this.inventories.filter(
                el => el.inventoryId === id
            )[0]
            return inventory
        },
        localProductsGet(id) {
            const product = this.products.filter(el => el.productId === id)[0]
            return product
        },
        localInventoriesAdd(inventory) {
            this.inventories.push(inventory)
        },
        localProductsAdd(product) {
            this.products.push(product)
        },
        localPrototypeAdd(prototype) {
            this.refillPrototypes.push(prototype)
        },
        /**
         * Modal form methods
         */
        handleModalSave: function (refillPrototype) {
            const refill = new Refill(refillPrototype)
            const inventory = this.localInventoriesGet(
                refillPrototype.inventoryId
            )
            const product = this.localProductsGet(refillPrototype.productId)
            inventory.currentAmount += refill.amount
            product.durability -= refill.amount

            this.dbRefillAdd(refill).then(response => {
                if (response) {
                    this.dbInventoryUpdate(inventory).then(response2 => {
                        if (response2) {
                            this.dbProductUpdate(product).then(response3 => {
                                if (response3) {
                                    this.resetAll()
                                    this.loadData()
                                    this.showModalMessage(
                                        'Info',
                                        'Successfully add refill and update inentory!'
                                    )
                                }
                            })
                        }
                    })
                }
            })
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
        },
        /**
         * Modal message methods
         */
        updateModalMessage: function (title, message) {
            this.modal.message.title = title
            this.modal.message.message = message
        },
        showModalMessage: function (title, message) {
            this.updateModalMessage(title, message)
            $('#' + this.modal.message.name).modal('show')
        },
        hideModalMessage: function () {
            $('#' + this.modal.message.name).modal('hide')
        },
        /**
         * Helper methods
         */
        resetAll() {
            this.refills = []
            this.products = []
            this.inventories = []
            this.refillPrototypes = []
        },
        loadData() {
            InventoryService.getRefill().then(response => {
                response.forEach((element, index) => {
                    this.localInventoriesAdd(new Inventory(element))
                    this.localProductsAdd(new Product(element))
                    this.localPrototypeAdd(new Prototype(element))
                })
            })
        }
    },
    created() {
        this.resetAll()
        this.loadData()
    }
}
</script>
<style>
.app-container {
    height: calc(100vh - 80px); /** minus navbar */
}
</style>
