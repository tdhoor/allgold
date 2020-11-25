import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Dashboard from './views/Dashboard.vue'
import Verkauf from './views/Verkauf.vue'
import Station from './views/Station.vue'
import Verkaufsstellen from './views/Verkaufsstellen.vue'
import Reporting from './views/Reporting.vue'
import Formulare from './views/Formulare.vue'
import Lieferanten from './views/Lieferanten.vue'

const Router = new VueRouter({
    routes: [
        { path: '/', component: Dashboard },
        { path: '/verkauf', component: Verkauf },
        { path: '/station', component: Station },
        { path: '/verkaufsstellen', component: Verkaufsstellen },
        { path: '/lieferanten', component: Lieferanten },
        { path: '/reporting', component: Reporting },
        { path: '/verkauf', component: Verkauf },
        { path: '/formulare', component: Formulare }
    ],
    mode: 'history'
})

export default Router
