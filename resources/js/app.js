import './bootstrap'
import Vue from 'vue'
import jQuery from 'jquery'
import PerfectScrollbar from 'perfect-scrollbar'
import RestaurantSearch from './components/RestaurantSearch'

// Vueとjqueryを共存
global.jquery = jQuery
global.$ = jQuery
window.$ = window.jQuery = require('jquery')

const app = new Vue({
  el: '#app',
  components: {
    RestaurantSearch,
  }
})
