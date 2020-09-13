/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        search: '',
        search_result: [],
        url: '/book/ajax',
        is_modal_open: false
    },
    mounted : function(){

        axios({
            method: 'GET',
            url: this.url,
            params: {'word':this.search} 
        }).then(function(res) {

            $.each(res.data, function(key,element) {

                this.search_result.push(element)                    
            }.bind(this))

            console.log(this.search_result)

        }.bind(this)).catch(function(error){

            console.log(error)
        })
    
    },
    watch: {
        search: function(value) {
            
            this.search_result = []

            axios({
                method: 'GET',
                url: this.url,
                params: {'word':value} 
            }).then(function(res) {
    
                $.each(res.data, function(key,element) {

                    this.search_result.push(element)                    
                }.bind(this))

                console.log(this.search_result)

            }.bind(this)).catch(function(error){

                console.log(error)
            })
        }           
    },
    methods: {
        delete_search: function() {

            this.search = ''
        },
        openModal: function() {

            this.is_modal_open = !this.is_modal_open
        }
    }
});
