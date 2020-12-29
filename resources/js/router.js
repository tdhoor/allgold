import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Dashboard from './views/Dashboard.vue'
import Verkauf from './views/Verkauf.vue'
import Verkaufsstellen from './views/Verkaufsstellen.vue'
import Reporting from './views/Reporting.vue'
import Formulare from './views/Formulare.vue'
import Lieferanten from './views/Lieferanten.vue'
import LieferantenRefill from './views/LieferantenRefill.vue'

const Router = new VueRouter({
    routes: [
        { path: '/projects/allgold/', component: Dashboard },
        { path: '/projects/allgold/verkauf', component: Verkauf },
        {
            path: '/projects/allgold/verkaufsstellen',
            component: Verkaufsstellen
        },
        { path: '/projects/allgold/lieferanten', component: Lieferanten },
        {
            path: '/projects/allgold/lieferanten/refill',
            component: LieferantenRefill
        },
        { path: '/projects/allgold/reporting', component: Reporting },
        { path: '/projects/allgold/formulare', component: Formulare }
    ],
    mode: 'history'
})

export default Router
