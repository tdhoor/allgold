<template>
    <div>
        <Header v-bind:subPages="navItems" />
        <h1>
            This app is not hosted on my server and is therefore currently not
            available.
        </h1>
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
            navItems: []
        }
    },
    methods: {}
}
</script>
