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
                        <button
                            class="btn btn-primary"
                            @click="clickRefreshProducts"
                        >
                            Aktualisieren
                        </button>
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
                            <button
                                class="btn btn-primary"
                                @click="clickCheckoutShoppingcar"
                            >
                                Abschließen
                            </button>
                            <button
                                class="btn btn-warning"
                                @click="clickResetShoppingcar"
                            >
                                Zurücksetzten
                            </button>
                        </div>
                        <div class="d-flex align-items-center">
                            <span>Totaler Preis: &#160; &#160;</span>
                            <span class="totalprice">{{ totalPrice }} €</span>
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
import Sale from '../utils/Sale'
import Shoppingcar from '../utils/Shoppingcar'

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
            shoppingcarCheck: [],
            stationid: null,
            totalPrice: 0,
            sale: {},
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
        /**
         * DB methods
         */
        loadInventoryFromDb: function (id) {
            InventoryService.getInventory(id).then(response => {
                response.forEach(element => {
                    let product = new Product(element)
                    let inventory = new Inventory(element)

                    this.addInventoryToLocalStorage(inventory)

                    if (inventory.currentAmount !== 0) {
                        this.addProductToLocalStorage(product, inventory)
                    }
                })
            })
        },
        addShoppingcarToDb(product, saleId, amount = 1) {
            let shoppingcar = new Shoppingcar({
                fk_productId: product.productId,
                fk_saleId: saleId,
                amount: amount
            })
            return new Promise((resolve, reject) => {
                ShoppingcarService.store(shoppingcar).then(response => {
                    if (response.status === 200) {
                        resolve(response.data[0])
                    } else {
                        reject('Error by saving shoppingcar into db')
                    }
                })
            })
        },
        addNewSaleToDb: function () {
            this.sale = new Sale({
                stationId: this.stationid,
                totalPrice: this.totalPrice
            })
            return new Promise((resolve, reject) => {
                SaleService.store(this.sale).then(response => {
                    if (response.status === 200) {
                        resolve(response.data[0])
                    } else {
                        reject('Error by sale into db')
                    }
                })
            })
        },
        /**
         * Btns onclick methods
         */
        clickTableAction: function (product) {
            this.addProductToLocalShoppingcar(product)
            this.updateShoppingcarTotalPrice()
        },
        clickTableDelete: function (product) {
            this.deleteProductFromLocalShoppingcar(
                this.getProductIndexFromShoppingcar(product)
            )
            this.updateShoppingcarTotalPrice()
        },
        clickResetShoppingcar: function () {
            this.resetAll()
            this.updateShoppingcarTotalPrice()
        },
        clickCheckoutShoppingcar: function () {
            if (this.shoppingcar.length === 0) {
                this.showModalMessage(
                    'Error',
                    'You need to add a product to the shoppingcar!'
                )
            }
            this.addNewSaleToDb()
                .then(sale => {
                    this.shoppingcar.forEach((product, index) =>
                        this.addShoppingcarToDb(product, sale.saleId)
                            .then(result => {
                                this.shoppingcarCheck.push(result)
                                if (
                                    index + 1 === this.shoppingcar.length &&
                                    index + 1 === this.shoppingcarCheck.length
                                ) {
                                    this.showModalMessage(
                                        'Info',
                                        this.generateBill(
                                            sale,
                                            this.shoppingcar
                                        )
                                    )
                                    this.resetAll()
                                    this.updateShoppingcarTotalPrice()
                                }
                            })
                            .catch(error => {
                                this.resetAll()
                                this.showModalMessage('Error', error)
                            })
                    )
                })
                .catch(error => {
                    this.resetAll()
                    this.showModalMessage('Error', error)
                })
        },
        clickRefreshProducts: function () {
            this.loadInventoryFromDb()
        },
        /**
         * Local storage methods
         */
        getProductById(id) {
            const product = this.products.filter(el => el.productId === id)
            return product
        },
        addInventoryToLocalStorage(inventory) {
            this.inventories.push(inventory)
        },
        addProductToLocalStorage(product, inventory) {
            this.products.push({
                productId: product.productId,
                price: product.price,
                name: product.name,
                currentAmount: inventory.currentAmount,
                targetAmount: inventory.targetAmount
            })
        },
        addProductToLocalShoppingcar(product) {
            let pro = this.getProductById(product.productId)
            this.shoppingcar.push(JSON.parse(JSON.stringify(product)))
        },
        getProductIndexFromShoppingcar(product) {
            return this.shoppingcar.findIndex(
                el => el.productId === product.productId
            )
        },
        deleteProductFromLocalShoppingcar(index) {
            this.shoppingcar.splice(index, 1)
        },
        deleteAllProductsFromLocalShoppingcar() {
            this.shoppingcar.splice(0, this.shoppingcar.length)
        },
        updateShoppingcarTotalPrice() {
            this.totalPrice = this.shoppingcar.reduce(
                (sum, { price }) => sum + price,
                0
            )
        },
        resetAll() {
            this.shoppingcarCheck.splice(0, this.shoppingcarCheck.length)
            this.deleteAllProductsFromLocalShoppingcar()
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
         * Helpers
         */
        generateHtml(name, element) {
            return `   <span style="display: flex; width: 100%; justify-content: space-between; flex-direction: row;">
                    <span>${name}</span>
                    <span>${element}</span>
                </span>`
        },
        generateBill(sale, products) {
            const saleID = this.generateHtml('Rechnungsnummer', sale.saleId)
            const date = this.generateHtml('Datum', sale.created_at)
            const totalPrice = this.generateHtml('Gesamtpreis', sale.totalPrice)
            const productInfos = products.reduce(
                (result, { name, price }) =>
                    (result += this.generateHtml(name, price)),
                ''
            )
            return saleID + date + productInfos + totalPrice
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
