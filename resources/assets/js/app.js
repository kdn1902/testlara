
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/*import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('mydatepicker', require('./components/MyDatepicker.vue'));
Vue.component('dept', require('./components/Department.vue'));
Vue.component('post', require('./components/Post.vue'));

import {ServerTable, ClientTable, Event} from 'vue-tables-2';
import axios from 'axios';

Vue.use(ServerTable, {}, false, require('../../../node_modules/vue-tables-2/compiled/template.js')('server'))
