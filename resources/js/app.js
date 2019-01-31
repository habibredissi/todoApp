require('./bootstrap');

window.Vue = require('vue');
import {
    store
} from './store/store';

import Router from './routes.js'
import Auth from './packages/auth/Auth.js'

Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('todos', require('./components/Todos.vue').default);
Vue.component('addtask', require('./components/AddTask.vue').default);
Vue.component('lists', require('./components/Lists.vue').default);

Vue.use(Auth);

Router.beforeEach(
    (to, from, next) => {
        if (to.matched.some(record => record.meta.forVisitors)) {
            if (Vue.auth.isAuthenticated()) {
                next({
                    path: '/'
                })
            } else {
                next()
            }
        } else if (to.matched.some(record => record.meta.forAuth)) {
            if (!Vue.auth.isAuthenticated()) {
                next({
                    path: '/login'
                })
            } else {
                next()
            }
        } else {
            next()
        }
    }
)

const app = new Vue({
    store: store,
    el: '#app',
    router: Router
});
