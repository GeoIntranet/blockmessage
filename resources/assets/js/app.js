
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery');
window.Tether = require('tether');
window.Vue = require('vue');
require('bootstrap');
window.axios = require('axios');
import Echo from'laravel-echo'

let e = new Echo({
    broadcaster : 'socket.io',
    host : window.location.hostname + ':6001'
});

e.channel('chan-demo')
    .listen('PostCreateEvent',(e)=>{
        //console.log(e)
    })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component('example', require('./components/Example.vue'));

 const app = new Vue({

     el: '#app',

     data : {
         message: ''
     },
     mounted() {
         e.channel('chan-demo')
             .listen('PostCreateEvent',(e)=>{
                 this.message = 'Nouveau Message';
                 console.log(e);
             })
     },
     methods: {
         clearMessage() {
             this.message='';
         },
         notify() {
             axios.get('/post');
         }
     }
 });
