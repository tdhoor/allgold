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
                    <div class="card-header">Available Products</div>
                    <div class="card-body">
                        <Table :items="products" :btnAction="true" />
                    </div>
                    <div class="card-footer text-muted">
                        <button
                            class="btn btn-primary"
                            @click="clickRefreshProducts"
                        >
                            Refresh
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
                                Checkout
                            </button>
                            <button
                                class="btn btn-warning"
                                @click="clickResetShoppingcar"
                            >
                                Cancel
                            </button>
                        </div>
                        <div class="d-flex align-items-center">
                            <span>Total price: &#160; &#160;</span>
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
            stationId: null,
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
        dbInventoryGet: function (id) {
            InventoryService.getInventory(id)
                .then(response => {
                    response.forEach(element => {
                        let product = new Product(element)
                        let inventory = new Inventory(element)

                        this.localInventoryAdd(inventory)

                        if (inventory.currentAmount !== 0) {
                            this.localProductsAdd(product, inventory)
                        }
                    })
                })
                .catch(error => this.showModalMessage('Error', error))
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
        dbInventoriesUpdate: function (inventories) {
            return new Promise((resolve, reject) => {
                inventories.forEach((element, index) => {
                    let newInventory = this.localInventoryUpdate(element)
                    this.dbInventoryUpdate(newInventory).then(response => {
                        if (index === inventories.length - 1) resolve(true)
                    })
                })
            })
        },
        dbShoppingcarAdd(product, saleId, amount = 1) {
            let shoppingcar = new Shoppingcar({
                fk_productId: product.productId,
                fk_saleId: saleId,
                amount: amount
            })
            return new Promise((resolve, reject) => {
                ShoppingcarService.store(shoppingcar)
                    .then(response => {
                        if (response.status === 200) {
                            resolve(response.data[0])
                        }
                    })
                    .catch(error => this.showModalMessage('Error', error))
            })
        },
        dbShoppingcarsAdd: function (shoppingcar, saleId) {
            return new Promise((resolve, reject) => {
                shoppingcar.forEach((element, index) => {
                    this.dbShoppingcarAdd(element, saleId).then(response => {
                        if (index === shoppingcar.length - 1) resolve(true)
                    })
                })
            })
        },
        dbSaleAdd: function () {
            this.sale = new Sale({
                stationId: this.stationId,
                totalPrice: this.totalPrice
            })
            return new Promise((resolve, reject) => {
                SaleService.store(this.sale)
                    .then(response => {
                        if (response.status === 200) {
                            resolve(response.data[0])
                        }
                    })
                    .catch(error => this.showModalMessage('Error', error))
            })
        },
        /**
         * Btns onclick methods
         */
        clickTableAction: function (product) {
            this.localShoppingcarAddProduct(product)
            this.localTotalPriceUpdate()
        },
        clickTableDelete: function (product) {
            this.localShoppingcarDeleteProduct(
                this.localShoppingcarGetProductIndex(product)
            )
            this.localTotalPriceUpdate()
        },
        clickResetShoppingcar: function () {
            this.localResetAll()
            this.localTotalPriceUpdate()
        },
        clickCheckoutShoppingcar: function () {
            if (this.shoppingcar.length === 0) {
                this.showModalMessage(
                    'Error',
                    'You need to add a product to the shoppingcar!'
                )
            }
            this.dbSaleAdd().then(responseSale => {
                /**
                 * Add Shoppingcar
                 */
                this.dbShoppingcarsAdd(
                    this.shoppingcar,
                    responseSale.saleId
                ).then(responseShoppingcar => {
                    if (responseShoppingcar) {
                        /**
                         * Update Inventory
                         */
                        this.dbInventoriesUpdate(this.shoppingcar).then(
                            responseInventories => {
                                if (responseInventories) {
                                    /**
                                     * Generate Bill and reset all
                                     */
                                    this.showModalMessage(
                                        'Info',
                                        this.generateBill(
                                            responseSale,
                                            this.shoppingcar
                                        )
                                    )
                                    this.localResetAll()
                                    this.localTotalPriceUpdate()
                                }
                            }
                        )
                    }
                })
            })
        },
        clickRefreshProducts: function () {
            this.localResetAll()
            this.dbInventoryGet(this.stationId)
        },
        /**
         * Local storage methods
         */
        localProductsGet(id) {
            const product = this.products.filter(el => el.productId === id)
            return product
        },
        localInventoryAdd(inventory) {
            this.inventories.push(inventory)
        },
        localProductsAdd(product, inventory) {
            if (inventory.currentAmount <= 0) return
            this.products.push({
                productId: product.productId,
                price: product.price,
                name: product.name
                // currentAmount: inventory.currentAmount
                // targetAmount: inventory.targetAmount
            })
        },
        localShoppingcarAddProduct(product) {
            let pro = this.localProductsGet(product.productId)
            this.shoppingcar.push(JSON.parse(JSON.stringify(product)))
        },
        localShoppingcarGetProductIndex(product) {
            return this.shoppingcar.findIndex(
                el => el.productId === product.productId
            )
        },
        localShoppingcarDeleteProduct(index) {
            this.shoppingcar.splice(index, 1)
        },
        localTotalPriceUpdate() {
            this.totalPrice = this.shoppingcar.reduce(
                (sum, { price }) => sum + price,
                0
            )
        },
        localgetInventoryIndex(productId) {
            return this.inventories.findIndex(
                el =>
                    el.fk_stationId === this.stationId &&
                    el.fk_productId === productId
            )
        },
        localInventoryUpdate({ productId }) {
            let index = this.localgetInventoryIndex(productId)
            this.inventories[index].currentAmount--
            return this.inventories[index]
        },
        localResetAll() {
            this.shoppingcar.splice(0, this.shoppingcar.length)
            this.inventories.splice(0, this.inventories.length)
            this.products.splice(0, this.products.length)
            this.dbInventoryGet(this.stationId)
        },
        /**
         * Modal form methods
         */
        handleModalSave: function (station) {
            this.stationId = parseInt(station.stationPrimaryKey)
            this.dbInventoryGet(this.stationId)
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
        this.stationId = null
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
