<template>
    <div>
        <Header v-bind:subPages="navItems" />
        <h1>formulare</h1>
    </div>
</template>

<script>
import Header from '../components/Header'

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
    methods: {}
}
</script>
