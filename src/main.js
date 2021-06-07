import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false;
 import store from './store/index.js'
import VueRouter from 'vue-router'
import iziToast from 'izitoast'
import Modal from './components/admin/Modal.vue'

// const axios = require('axios');
Vue.component('Modal', Modal)
import axios from 'axios';


let VueProtoType = new Vue();
Vue.prototype.$eventHandelar = VueProtoType;
Vue.prototype.$iziToast = iziToast;


Vue.use(VueRouter);

new Vue({
    axios,
  render: h => h(App),
  store 
}).$mount('#app');
