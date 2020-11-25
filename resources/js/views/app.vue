<template>
    <div class="app">
        <router-view />
    </div>
</template>

<script>
import Header from '../components/Header'

export default {
    components: {
        Header
    },
    computed: {},
    methods: {},
    data() {
        return {}
    }
}
</script>

<style scoped>
.app {
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}
</style>
