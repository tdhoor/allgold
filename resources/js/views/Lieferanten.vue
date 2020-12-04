<template>
    <div>
        <Header v-bind:subPages="navItems" />
        <button @click="clickGetAll">getAll</button>
    </div>
</template>

<script>
import Header from '../components/Header'

import Refill from '../utils/Refill'
import RefillService from '../services/RefillService'

import Refillcar from '../utils/Refillcar'
import RefillcarService from '../services/RefillcarService'

export default {
    components: {
        Header
    },
    computed: {},
    data() {
        return {
            message: 'hellow',
            navItems: [
                {
                    url: 'http://www.allgold.de/verkaufsstellen',
                    name: 'Verkaufsstellen'
                },
                {
                    url: 'http://www.allgold.de/lieferanten',
                    name: 'Lieferanten'
                },
                { url: 'http://www.allgold.de/verkauf', name: 'Verkauf' },
                { url: 'http://www.allgold.de/reporting', name: 'Reporting' },
                { url: 'http://www.allgold.de/formulare', name: 'Formulare' }
            ]
        }
    },
    methods: {
        clickGetAll: function (el) {
            RefillService.getAll().then(response =>
                console.log('RefillService: ', response)
            )
            RefillcarService.getAll().then(response =>
                console.log('RefillcarService: ', response)
            )
        }
    }
}
</script>
