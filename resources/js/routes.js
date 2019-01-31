import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from './components/Login.vue'
import Home from './components/Home.vue'
import Register from './components/Register.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [{
            path: "/",
            component: Home,
            meta: {
                forAuth: true
            }
        },
        {
            path: "/login",
            component: Login,
            meta: {
                forVisitors: true
            }
        },
        {
            path: "/register",
            component: Register,
            meta: {
                forVisitors: true
            }
        }
    ]
})

export default router
