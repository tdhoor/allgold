<template>
    <div class="app-inner">
        <Header />
        <Modal
            :modalName="modalName"
            :items="modalItem"
            :title="'Verkaufsstelle Bearbeiten:'"
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
// services
import StationService from '../services/StationService'
// utils
import Station from '../utils/Station'

export default {
    name: 'Verkaufsstellen',
    components: {
        Header,
        Table,
        Modal
    },
    computed: {},
    data() {
        return {
            stations: [],
            modalName: 'modalEdit',
            modalItem: {}
        }
    },
    methods: {
        loadStations: function () {
            StationService.getAll().then(result => {
                result.data.forEach(element => {
                    let station = new Station(element)
                    this.stations.push(station)
                })
            })
        },
        clickTableEdit: function (station) {
            this.modalItem = station
            $('#' + this.modalName).modal('show')
        },
        clickTableDelete: function (station) {
            console.log(station)
        },
        saveEntry: function (station) {
            let that = this

            StationService.update(station.toJSON()).then(result => {
                this.updateEntry(result)
                $('#' + this.modalName).modal('hide')
            })
        },
        updateEntry: function (station) {
            const index = this.stations.findIndex(
                x => x.stationid === station.stationid
            )
            this.stations.splice(index, 1, station)
        }
    },
    watch: {
        stations: {
            handler(newItem) {
                return newItem
            },
            deep: true
        }
    },
    created() {
        this.loadStations()
    }
}
</script>
