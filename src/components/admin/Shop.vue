<template>
  <div class="content pure-u-1 pure-u-md-21-24">
    <div class="header-small">
      <div class="items">
        <div class="subhead">
          Dashboard
          <a class="btn btn-danger button-xsmall" style="float:right ;margin-top:-1%;color:white" href="javaScript:void(0)" @click="showHide = true">Cart</a>
        </div>
      </div>
      <div style="position:absolute ; margin-top:-2%;width:80%" v-if="showHide">
        <div class="modal-dialog" role="document" style="width:80%">
          <div class="modal-content" style="background-color: rgb(103, 165, 100);color: whitesmoke ;margin-left: 77%;width:70%; border: 3px solid #367560;">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" style="color: whitesmoke" @click="showHide=false">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="pure-table pure-table-horizontal" style="font-size:12px">
                <thead>
                  <tr>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(cartItem,index) in cart" :key="index">
                    <td><img :src="'http://127.0.0.1:8000/product/images/'+cartItem.product.image" width="50%" /></td>
                    <td> &#2547; {{cartItem.product.price}}</td>
                    <td><input type="number" v-model="cartItem.quantity" style="width:100%" ></td>
                    <td> &#2547; {{cartItem.product.price * cartItem.quantity}}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" @click="removeFromCart(index)" >X</button></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td>&#2547; {{total}}</td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" @click.prevent="showHide=false">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div>
        <div class="pure-g mt-2" v-if="!loading" >
        <div class="pure-u-2 pure-u-md-1-4" v-for="(item,index) in items" :key="index">
          <div class="column-block" style="box-shadow: rgba(0, 0, 0, 0.75) 10px 10px 5px 0px;">
            <div class="column-block-header column-success" style="background-color:white ; border:1px solid #d4c2c2 ;">
              <img :src="'http://127.0.0.1:8000/product/images/'+item.image"  class="img-thumbnail" width="50%">
            </div>
            <ul class="column-block-list">
              <li>
                Price
                <span class="buble-success button-small pull-right">&#2547;{{item.price}}</span>
              </li>
              <li>
                Quantity
                <span class="buble-secondary button-small pull-right">{{item.quantity}}</span>
              </li>
              <li>
                Total Price
                <span class="buble-warning button-small pull-right">&#2547; {{item.price * item.quantity}}</span>
              </li>
              <li style="text-align:center ;">
                <a class="buble-warning button-small text-white" style="text-decoration:none" href="javaScript:void(0)" @click="addToCart(item.id)" >Add to cart</a>
                <a class="buble-success button-small text-white ml-1" style="text-decoration:none" href="javaScript:void(0)"><router-link :to="'product-view/'+item.id">View Details</router-link></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="pure-g mt-2" v-else>
          <img src="/assets/loading/loader.gif" style="margin-left: 35% ; margin-top: 10%">
      </div>
    </div>

    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Shop",
  data() {
    return {
      items: [],
      showHide : false,
      loading:true,
      qty:1,
    
    };
  },
  mounted() {
    let selfObj = this;
    selfObj.fatchData();
    selfObj.$eventHandelar.$on("addToCart" , payload=>{
      selfObj.cart.push(payload);
    })
  },
  methods: {
    fatchData() {
      let obj = this;
    //   obj.loading = true;
      axios.get("http://127.0.0.1:8000/api/v1/products")
        .then(function(response) {
        //   setTimeout(function() {
            obj.items = response.data.products;
            obj.loading = false
            //                        console.log(response);
            // obj.loading = false;
        //   }, 3000);
          // handle success
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    addToCart(data){
      let obj = this;
      obj.$store.dispatch('addToCartByAction' , data);
            // let obj = this;
            // obj.$store.commit('addToCart', 
            //   { product : obj.viewDetailsItem , quantity : obj.qty}
            // )
//             let obj = this;
//                 obj.viewDetailsVar = false;
// //                let id = this.data;
//                 axios.get("http://127.0.0.1:8000/api/v1/product"+"/"+data)
//                     .then(function (response) {
//                         console.log(response);
//                         let v = response.data.product;
//                         obj.$store.commit('addToCart', 
//                             { product :v , quantity : obj.qty}
//                           )
//                     })
//                     .catch(function (error) {
//                         // handle error
//                         console.log(error);
//                     })
          },
          removeFromCart(index){
            let obj = this;
            obj.$store.commit('removeFromCart' , index)
          }

  },
    computed:{
        cart(){
            return this.$store.getters.getCart;
        },
        total(){
              return this.$store.getters.getTotal;
            }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped></style>
