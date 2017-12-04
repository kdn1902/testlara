
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/ExampleComponent.vue'));


const app = new Vue({
    el: '#app'
});

import {ServerTable, ClientTable, Event} from 'vue-tables-2';
import axios from 'axios'
Vue.use(ServerTable, {}, false, require('../../../node_modules/vue-tables-2/compiled/template.js')('server'))

new Vue({
    el: "#serverpeople",
    data: {
        columns: ['id', 'lastname', 'firstname', 'otchestvo','birthday'],
        options: {
        	headings:{
        		id: '№',
            	lastname: 'Фамилия',
              	firstname: 'Имя',
              	otchestvo: 'Отчество',
              	birthday: 'День рождения'
            },
            dateColumns: ['birthday'],
			params: {
				datefields: ['birthday']
			},
        	requestFunction: function (data) 
			{
				return axios.get(this.url, {
					params: data
				}).catch(function (e){
					this.dispatch('error', e);
				}.bind(this));
			}
        }
    },
    methods:{
			getemployee: function(id)
			{
				return "/getemployee/" + id;
			},
			getdate: function(ddate)
			{
				var d = new Date(ddate);
				return d.toLocaleFormat('%d %b %Y')
			}
    }
});	
