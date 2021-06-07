import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {
    appName: "Vue-js",
    cart: [],
  },
  mutations: {
    addToCart(state, payload) {
      // console.log('h=>'+state.cart)
      // console.log('payload=>'+payload)
      state.cart.push(payload);
    },

    removeFromCart(state, payload) {
      state.cart.splice(payload);
    },

    addToCartFromApi(state, payload) {
      // console.log(payload);
      axios.get("http://127.0.0.1:8000/api/v1/product" + "/" + payload)
        .then(function(response) {
          // console.log(response);
          let product = response.data.product;

          if (state.cart.length != 0){
            console.log('sagsdfhdh');
            for (let j = 0; j < state.cart.length; j++) {
              // console.log(state.cart[j].product.id);
              // console.log(payload);

              if(state.cart[j].product.id == payload){

                console.log(state.cart[j].quantity ++)

                console.log('xfhbfcxhngj')
              }else{
                state.cart.push({ product :product , quantity : 1});
              }

              // let item = state.cart[i];
              // total += item.quantity * item.product.price;
            }
          }else{
            state.cart.push({ product :product , quantity : 1});
          }




          // console.log(state.cart)

        }).catch(function(error) {
          // handle error
          console.log(error);
        });
    },
  },
  actions: {
    addToCartByAction(context, payload) {
      context.commit("addToCartFromApi", payload);
    },
  },
  getters: {
    getName: (state) => {
      return state.appName;
    },
    getCart: (state) => {
      return state.cart;
    },
    getTotal: (state) => {
      let total = 0;
      for (let i = 0; i < state.cart.length; i++) {
        let item = state.cart[i];
        total += item.quantity * item.product.price;
      }
      return total;
    },
  },
  plugins: [createPersistedState()],
});
export default store;
