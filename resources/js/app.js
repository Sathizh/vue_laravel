require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import App from './App.vue';
import Home from '../js/components/Home'
import Contactlist from '../js/components/Contactlist'
import AddContact from '../js/components/AddContact'
import EditContact from '../js/components/EditContact'

// sweet alert 2
import VueSweetalert2 from 'vue-sweetalert2';
window.Swal = require('sweetalert2');
Vue.use(VueSweetalert2);

import utils from './helpers/utilities';
Vue.prototype.$utils=utils

import VueAxios from 'vue-axios';
import axios from 'axios';
import Vue from 'vue';

Vue.use(VueAxios, axios);

const routes = [
    {
        name: '/',
        path: '/',
        component: Home,
    },
    {
        name: '/contacts',
        path: '/contacts',
        component: Contactlist,
    },
    {
        name: '/add_contact',
        path: '/add_contact',
        component: AddContact,
    },
    {
        name: '/search_contact',
        path: '/search_contact/edit/:id?',
        component: EditContact,
    },
];
const router = new VueRouter({mode:'history',routes:routes})
const app = new Vue(Vue.util.extend({router},App)).$mount('#app');
