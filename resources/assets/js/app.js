
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import SubscribedBooks from './components/SubscribedBooks.vue';
import ListItem from './components/GoogleBooks/ListItem.vue';
import GoogleBookDetails from './components/GoogleBooks/GoogleBookDetails.vue';

const app = new Vue({
    el: '#app',
    components: {
        SubscribedBooks,
        GoogleBookDetails,
        ListItem,
    },
    data: {
        showModal: false,
        searchterm: null,
    },
    mounted () {
      this.$on('toggle-book-details', function(value){
        console.log('fuuuuck');
      });
    },
    methods: {
      toggleBookDetails() {
        console.log('ass');
      }
    }
});
