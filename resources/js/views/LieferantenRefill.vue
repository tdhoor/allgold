<template>
    <div>
        <div class="app-inner">
            <Header v-bind:subPages="navItems" />
            <Subnav :btnRefresh="true" :title="'Action'" />
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
                        :items="refills"
                        :modalName="'editStation'"
                        :btnEdit="true"
                    />
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
import { URL_LIEFERANTEN, URL_LIEFERANTEN_STATUS } from '../server/Server'
import {
    APP_LIEFERANTEN_LIEFERUNG_TITLE,
    APP_LIEFERANTEN_STATUS_TITLE
} from '../utils/Variables'
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
            navItems: [
                {
                    url: URL_LIEFERANTEN,
                    name: APP_LIEFERANTEN_LIEFERUNG_TITLE
                },
                {
                    url: URL_LIEFERANTEN_STATUS,
                    name: APP_LIEFERANTEN_STATUS_TITLE
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
         * Button methods
         */
        clickTableEdit: function (refill) {
            this.showModalForm(
                METHOD_UPDATE,
                'Bearbeiten',
                refill.toModalJSON()
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
         * Handle subnav methods
         */
        handleRefresh: function () {
            this.resetAll()
            this.loadData()
        },
        /**
         * DB methods
         */
        dbRefillGetAll: function (refill) {
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
        dbRefillUpdate: function (refill) {
            return new Promise((resolve, reject) => {
                RefillService.update(refill)
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
        localRefillGet(id) {
            const product = this.refills.filter(el => el.refillId === id)[0]
            return product
        },
        localRefillAdd(inventory) {
            this.refills.push(inventory)
        },

        /**
         * Modal form methods
         */
        handleModalSave: function (refillPrototype) {
            const refill = this.localRefillGet(refillPrototype.refillId)
            refill.status = refillPrototype.status

            this.dbRefillUpdate(refill).then(response => {
                if (response) {
                    this.resetAll()
                    this.loadData()
                    this.showModalMessage('Info', 'Successfully add refill!')
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
        },
        loadData() {
            RefillService.getAll().then(response => {
                response.forEach((element, index) => {
                    this.localRefillAdd(new Refill(element))
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
