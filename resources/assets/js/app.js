
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
         userOnlineCounter: 0,
         title: '',
         group: '',
         users :[],
         typing :'',
         demo :'',
     },
     mounted() {

         this.listen();
         e.private('App.User.2')
             .notification( notification =>
                 console.log(notification)
             )
         e.channel('chan-demo')
             .listen('PostCreateEvent',(e)=>{
                 this.message = 'Nouveau Message';
                 console.log(e);
             })
         ;

        window.demo =  e.join('group.1')
             .here(function(users){
                 console.log(users);
                 return users
             })
             .joining(function(user) {
                 console.log('joinning '+ user.name)
             })
             .leaving(function(user) {
                 console.log('leaving '+ user.name)
             })
             .listen('PostGroupEvent', (e) =>{
                 this.group = e.message.titre;
                 console.log(e.message.titre)
             })

            .listenForWhisper('typing', e => {
                console.log('typing', e)
            })
        ;
     },

     methods: {
         listen(){
             e.join('group.1')
                 .here(users => {
                     this.users = users;
                     this.userOnlineCounter = users.length;
                 })
                 .joining( user => {
                     this.userOnlineCounter = this.userOnlineCounter+1;
                     this.users.push(user);
                     console.log('joinning '+ user.name);
                 })
                 .leaving( user => {
                     this.userOnlineCounter = this.userOnlineCounter - 1;
                     var index = this.users.map(e => {return e.name}).indexOf(user.name);
                     this.users.splice(index,1);;
                     console.log('leaving '+ user);
                 })
             ;
         },

         getOnline(){
             e.join('group.1')
                 .here(function(users){
                     return users
                 })
         },
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
