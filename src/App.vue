<template>
  <div id="app">
      <div v-if="preLoader">
        <img src="/assets/loading/loading-5.gif" style="height: 100px;width: 100px ; margin-top: 20% ; margin-left: 45%">
      </div>
      <div v-else  ><!--id="layout" class="pure-g"-->
          <!--<NavBar/>-->
        <router-view></router-view>
      </div>
  </div>
</template>

<script>
//import NavBar from './components/admin/NavBar.vue'
import LoginRegister from './pages/admin/LoginRegister.vue'
//import TopNavBar from './components/admin/TopNavBar.vue'
import Dashboard from './pages/admin/Dashboard.vue'
import Home from './components/admin/Home.vue'
import Product from './components/admin/Products.vue'
import ProductCreate from './components/admin/ProductCreate.vue'
// import Modal from './components/admin/Modal.vue'
import Data from './data/data.js'

import VueRouter from 'vue-router'
const routes = [
    // { path: '/', redirect:{path:'/login-register'}},
    { path: '/login-register', component: LoginRegister },
    { path: '/dashboard',
        component: Dashboard ,
        redirect:{path:'/dashboard/home'},
        children:[
            { path: 'home', component: Home },
            { path: 'products', component: Product },
            { path: 'product-create', component: ProductCreate },
            ]
    },
];


const router = new VueRouter({
    routes : routes ,// short for `routes: routes`
    mode : 'history'
});
export default {
  name: 'App',
  components: {
//      NavBar,
//        Modal
  },
    created(){
      this.$eventHandelar.$on('delayStatus' , payloadtype => {
          this.preLoader = payloadtype;
      })
    },
    router,
    data() {
      return{
          items :[],
          preLoader:false,
      }
    },
    mounted: function () {
    this.items = Data
}
}
</script>

<style>
</style>
