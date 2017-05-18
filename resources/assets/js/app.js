
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery');
window.Tether = require('tether');
window.Vue = require('vue');
window.axios = require('axios');
require('bootstrap');

import Echo from'laravel-echo'

let e = new Echo({
    broadcaster : 'socket.io',
    host : 'http://block.message:6001'
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component('example', require('./components/Example.vue'));

 const app = new Vue({

     el: '#app',

     data : {
         message: '',
         title: '',
         group: '',
     },
     mounted() {
         e.channel('chan-demo')
             .listen('PostCreateEvent',(e)=>{
                 this.message = 'Nouveau Message';
                 console.log(e);
             })
         ;

         e.private('group.1')
             .listen('PostGroupEvent', (e) =>{
                 this.group = e.message.titre;
                 console.log(e.message.titre)
             } )
         ;
     },
     methods: {
         clearMessage() {
             this.message='';
         },
         notifyGeneral() {
             axios.get('/general')
         },
         notify() {
             axios.get('/group')
         },
         notifyGroup() {
             axios.post('/group',{
                 title:this.title
             })
         }
     }
 });
