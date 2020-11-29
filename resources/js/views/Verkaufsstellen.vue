<template>
    <div class="app-inner">
        <Header />
        <Subnav :formSearch="true" :btnRefresh="true" :btnAdd="true" />
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
         * Table Methods
         */
        clickTableEdit: function (station) {
            this.showModalForm(METHOD_UPDATE_STATION, 'Bearbeiten', station)
        },
        clickTableDelete: function (station) {
            this.deleteStationFromDb(station)
        },
        /**
         * Subnav Methods
         */
        handleSearch: function (text) {
            this.searchStationsFromDb(text)
        },
        handleRefresh: function () {
            this.loadStationsFromDb()
        },
        handleAdd: function () {
            let dummy = Helper.getStationDummy()
            this.showModalForm(METHOD_NEW_STATION, 'Erstellen', dummy)
        },
        /**
         * Methods to handle data
         */
        addStationToDb: function (station) {
            StationService.create(station)
                .then(response => {
                    this.hideModalForm()
                    this.loadStationsFromDb()
                    this.showModalMessage(
                        'Info',
                        'Successfully created Station with id: ' +
                            response.stationid
                    )
                })
                .catch(error => {
                    this.showModalMessage('Error:', 'Check input fields!')
                })
        },
        searchStationsFromDb: function (text) {
            StationService.getByLocationOrId(text)
                .then(response => {
                    this.deleteAllLocalStations()
                    this.addEntries(response)
                })
                .catch(error => {
                    this.showModalMessage('Error', error)
                })
        },
        loadStationsFromDb: function () {
            StationService.getAll()
                .then(response => {
                    this.deleteAllLocalStations()
                    this.addEntries(response)
                })
                .catch(error => {
                    this.deleteAllLocalStations()
                    this.showModalMessage('Error', error)
                })
        },
        updateStationInDb: function (station) {
            StationService.update(station.toJSON())
                .then(response => {
                    this.updateEntry(new Station(response))
                    this.hideModalForm()
                    this.showModalMessage(
                        'Info',
                        'Successfully updated station with id: ' +
                            response.stationid
                    )
                })
                .catch(error => {
                    this.deleteAllLocalStations()
                    this.showModalMessage('Error', error)
                })
        },
        deleteStationFromDb: function (station) {
            const index = this.getLocalStationIndex(station)
            StationService.delete(station.stationid)
                .then(response => {
                    this.deletEntry(index)
                    this.showModalMessage(
                        'Info',
                        'Successfully deleted station with id: ' +
                            response.stationid
                    )
                })
                .catch(error => {
                    this.deleteAllLocalStations()
                    this.showModalMessage('Error', error)
                })
        },
        /**
         * Handle local stored data
         */
        updateEntry: function (station) {
            let index = this.getLocalStationIndex(station)
            this.stations.splice(index, 1, station)
        },
        deletEntry: function (index) {
            this.stations.splice(index, 1)
        },
        addEntries: function (stations) {
            stations.forEach(element => {
                let station = new Station(element)
                this.stations.push(station)
            })
        },
        /**
         * Modal form methods
         */
        handleModalSave: function (station) {
            if (this.modal.form.method === METHOD_UPDATE_STATION)
                this.updateStationInDb(station)
            if (this.modal.form.method === METHOD_NEW_STATION)
                this.addStationToDb(station)
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
        deleteAllLocalStations: function () {
            this.stations.splice(0, this.stations.length)
        },
        getLocalStationIndex: function (item) {
            const index = this.stations.findIndex(
                x => x.stationid === item.stationid
            )
            return index
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
        this.loadStationsFromDb()
    }
}
</script>
<style>
.app-container {
    height: calc(100% - 80px); /** minus navbar */
}
</style>
