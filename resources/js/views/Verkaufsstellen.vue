<template>
    <div class="app-inner">
        <Header />
        <div class="row app-container">
            <div class="col-12">
                <Table :items="stations" :btnEdit="true" :btnDelete="true" />
            </div>
        </div>
    </div>
</template>

<script>
// components
import Header from '../components/Header'
import Table from '../components/Table'
// services
import StationService from '../services/StationService'
// utils
import Station from '../utils/Station'

export default {
    name: 'Verkaufsstellen',
    components: {
        Header,
        Table
    },
    computed: {},
    data() {
        return {
            stations: []
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
            console.log(station)
        },
        clickTableDelete: function (station) {
            console.log(station)
        }
    },
    created() {
        this.loadStations()
    }
}
</script>
