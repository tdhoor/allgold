require('./bootstrap')

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//Main page
import App from './views/App.vue'

import Router from './router.js'

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router
})
