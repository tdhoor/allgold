<template>
    <div class="app-inner">
        <Header />
        <Subnav
            :formSearch="true"
            :btnRefresh="true"
            :btnAdd="true"
            :title="'Action'"
        />
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
                    :items="stations"
                    :modalName="'editStation'"
                    :btnEdit="true"
                    :btnDelete="true"
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
// services
import StationService from '../services/StationService'
// utils
import Station from '../utils/Station'

import Helper from '../helper/Helper'

const METHOD_GET_STATION = 'getstation'
const METHOD_UPDATE_STATION = 'updatestation'
const METHOD_DELETE_STATION = 'deletestation'
const METHOD_NEW_STATION = 'newstation'

export default {
    name: 'Verkaufsstellen',
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
            stations: [],
            modal: {
                form: {
                    name: 'modalEdit',
                    title: 'Verkaufsstelle Bearbeiten:',
                    method: METHOD_GET_STATION,
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
         * Handle table methods
         */
        clickTableEdit: function (station) {
            this.showModalForm(METHOD_UPDATE_STATION, 'Bearbeiten', station)
        },
        clickTableDelete: function (station) {
            this.dbStationsDelete(station)
        },
        /**
         * Handle subnav methods
         */
        handleSearch: function (text) {
            this.dbStationsSearch(text)
        },
        handleRefresh: function () {
            this.dbStationsGetAll()
        },
        handleAdd: function () {
            let dummy = Helper.getStationDummy()
            this.showModalForm(METHOD_NEW_STATION, 'Erstellen', dummy)
        },
        /**
         * Handle data from DB
         */
        dbStationsAdd: function (station) {
            StationService.create(station)
                .then(response => {
                    this.hideModalForm()
                    this.dbStationsGetAll()
                    this.showModalMessage(
                        'Info',
                        'Successfully created Station with id: ' +
                            response.stationId
                    )
                })
                .catch(error => {
                    this.showModalMessage('Error:', 'Check input fields!')
                })
        },
        dbStationsSearch: function (text) {
            StationService.getByLocationOrId(text)
                .then(response => {
                    this.localStationsDeleteAll()
                    this.localStationsAdd(response)
                })
                .catch(error => {
                    this.showModalMessage('Error', error)
                })
        },
        dbStationsGetAll: function () {
            StationService.getAll()
                .then(response => {
                    this.localStationsDeleteAll()
                    this.localStationsAdd(response)
                })
                .catch(error => {
                    this.localStationsDeleteAll()
                    this.showModalMessage('Error', error)
                })
        },
        dbStationsUpdate: function (station) {
            StationService.update(station.toJSON())
                .then(response => {
                    this.localStationsUpdate(new Station(response))
                    this.hideModalForm()
                    this.showModalMessage(
                        'Info',
                        'Successfully updated station with id: ' +
                            response.stationId
                    )
                })
                .catch(error => {
                    this.localStationsDeleteAll()
                    this.showModalMessage('Error', error)
                })
        },
        dbStationsDelete: function (station) {
            const index = this.localStationsGetIndex(station)
            StationService.delete(station.stationId)
                .then(response => {
                    this.localStationsDelete(index)
                    this.showModalMessage(
                        'Info',
                        'Successfully deleted station with id: ' +
                            response.stationId
                    )
                })
                .catch(error => {
                    this.localStationsDeleteAll()
                    this.showModalMessage('Error', error)
                })
        },
        /**
         * Handle local stored data
         */
        localStationsUpdate: function (station) {
            let index = this.localStationsGetIndex(station)
            this.stations.splice(index, 1, station)
        },
        localStationsDelete: function (index) {
            this.stations.splice(index, 1)
        },
        localStationsAdd: function (stations) {
            stations.forEach(element => {
                let station = new Station(element)
                this.stations.push(station)
            })
        },
        localStationsDeleteAll: function () {
            this.stations.splice(0, this.stations.length)
        },
        localStationsGetIndex: function (item) {
            const index = this.stations.findIndex(
                x => x.stationId === item.stationId
            )
            return index
        },
        /**
         * Modal form methods
         */
        handleModalSave: function (station) {
            if (this.modal.form.method === METHOD_UPDATE_STATION)
                this.dbStationsUpdate(station)
            if (this.modal.form.method === METHOD_NEW_STATION)
                this.dbStationsAdd(station)
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
        }
    },
    watch: {
        stations: {
            handler(newItem) {
                return newItem
            },
            deep: true
        },
        modal: {
            handler(newItem) {
                return newItem
            },
            deep: true
        }
    },
    created() {
        this.dbStationsGetAll()
    }
}
</script>
<style>
.app-container {
    height: calc(100vh - 80px); /** minus navbar */
}
</style>
