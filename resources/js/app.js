/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//Import Form & error messages from vform
import {
    Form,
    HasError,
    AlertError
} from 'vform';

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);


import Swal from 'sweetalert2'
window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})
// Vue route paths
let routes = [{
        path: '/dashboard',
        component: require('./components/Dashboard.vue').default
    },
    {
        path: '/users',
        component: require('./components/Users.vue').default
    },
    {
        path: '/map',
        component: require('./components/Map.vue').default
    },
    {
        path: '/developer',
        component: require('./components/Developer.vue').default
    },

    {
        path: '/profile',
        component: require('./components/Profile.vue').default
    },

    {
        path: '*',
        component: require('./components/NotFound.vue').default
    }


]

// Register routes to VueRouter
const router = new VueRouter({
    mode: "history",
    routes,
    linkActiveClass: 'active'
})


let Fire = new Vue();
window.Fire = Fire;








/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);

const app = new Vue({
    el: '#app',
    router
});
