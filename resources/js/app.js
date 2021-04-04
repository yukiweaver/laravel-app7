import './bootstrap'
import Vue from 'vue'
import jQuery from 'jquery'
import RestaurantSearch from './components/RestaurantSearch'
import Test from './components/Test'
import Test2 from './components/Test2'

// Vueとjqueryを共存
global.jquery = jQuery
global.$ = jQuery
window.$ = window.jQuery = require('jquery')

const app = new Vue({
  el: '#app',
  components: {
    RestaurantSearch,
    Test,
    Test2,
  }
})
