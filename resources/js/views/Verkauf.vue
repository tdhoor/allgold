<template>
    <div class="app-inner">
        <Header />
        <div class="row app-container">
            <div class="col-6 container-products">
                <Table :items="products" :btnAction="true" />
            </div>
            <div class="col-6 container-console"></div>
        </div>
    </div>
</template>

<script>
// components
import Header from '../components/Header'
import Table from '../components/Table'
// services
import ProductService from '../services/ProductService.js'
import SaleService from '../services/SaleService.js'
import ShoppingcarService from '../services/ShoppingcarService.js'
import InventoryService from '../services/InventoryService.js'
// utils
import Product from '../utils/Product'

export default {
    name: 'Verkauf',
    components: {
        Header,
        Table
    },
    computed: {},
    data() {
        return {
            products: [],
            shoppingcar: [],
            stationid: 1
        }
    },
    methods: {
        loadProducts: function () {
            InventoryService.getInventory(2).then(result => {
                result.data.forEach(element => {
                    let product = new Product(element)
                    this.products.push(product)
                })
            })
        },
        clickTableAction: function (product) {
            console.log(product)
        }
    },
    created() {
        this.loadProducts()
    }
}
</script>
