require('./bootstrap');

window.Vue = require('vue');

import vuelidate from 'vuelidate'
import VueRouter from 'vue-router'
import Tasks from './views/Tasks'
import Update from './views/Update'
Vue.use(VueRouter)
Vue.use(vuelidate)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'tasks',
            component: Tasks
        },
        {
            path: '/:id',
            name: 'updateTask',
            component: Update
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
})

const app = new Vue({
    el: '#app',
    router
});
