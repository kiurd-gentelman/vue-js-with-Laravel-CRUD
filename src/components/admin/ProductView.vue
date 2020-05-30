<template>
    <div class="content pure-u-1 pure-u-md-21-24">
        <div class="header-small">

            <div class="items">
                <div class="subhead">Dashboard
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
                    <td>{{cartItem.product.price}}</td>
                    <td><input type="number" v-model="cartItem.quantity" style="width:100% ; height:20%" ></td>
                    <td>{{cartItem.product.price * cartItem.quantity}}</td>
                    <td><button type="button" class="btn btn-danger btn-sm" @click="removeFromCart(index)">X</button></td>
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

            <div class="pure-g mt-5" v-if="!loading" >
              <div>
                <div class="pure-u-1 pure-u-md-1-2">
                    <div class="column-block">
                        <img :src = "'http://127.0.0.1:8000/product/images/'+ viewDetailsItem.image" style="width:70%" class="img-thumbnail">
                    </div>
                </div>

                <div class="pure-u-1 pure-u-md-1-2">
                    <div class="column-block">
                        <h3>Product name : {{viewDetailsItem.name}}</h3>
                        <h4>Product Price : {{viewDetailsItem.price}}</h4>
                        <h4>Product Quantity : <input type="number" v-model="qty"></h4>
                        <h5>Product name : {{viewDetailsItem.description}}</h5>
                    </div>
                    <div>
                        <button class="btn btn-success" @click.prevent="addToCart()">Add to cart</button>
                        <button class="btn btn-info ml-1">Shopping Continue</button>
                    </div>
                </div>

                </div>
            </div>
            <div class="pure-g" v-else>
                 <img src="/assets/loading/loader.gif" style="margin-left: 35% ; margin-top: 10%">
            </div>

            <div class="footer">
                <div class="pure-menu pure-menu-horizontal">
                    <ul>
                        <li class="pure-menu-item"><a href="http://purecss.io/" class="pure-menu-link">PURE CSS</a></li>
                        <li class="pure-menu-item"><a href="http://fikiruretgeci.com" class="pure-menu-link">FIKIR URETGECI</a></li>
                        <li class="pure-menu-item"><a href="http://pure-themes.com" class="pure-menu-link">PURE THEMES</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
// import { mapGetters } from 'vuex';
    export default {
        name: 'ProductView',
        data(){
            return{
                loading:true,
                productID : this.$route.params.id,
                viewDetailsItem : [],
                showHide : false,
                qty : 1,
            }
        },
        props: {
            msg: String
        },
        mounted(){
            let obj = this;
            let data = obj.productID;
//                let id = this.data;
                obj.loading =  true;
                axios.get("http://127.0.0.1:8000/api/v1/product"+"/"+data)
                    .then(function (response) {
                        console.log(response);
                        obj.viewDetailsItem = response.data.product;
                        // handle success
                        // obj.qty = obj.viewDetailsItem.quantity;
                        obj.loading =  false;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
        },
        methods: {
          addToCart(){
            let obj = this;
            obj.$store.commit('addToCart', 
              { product : obj.viewDetailsItem , quantity : obj.qty}
            )
          },
          removeFromCart(index){
            let obj = this;
            obj.$store.commit('removeFromCart' , index)
          }
        },
        computed:{
            // ...mapGetters({
            //     // map `this.doneCount` to `this.$store.getters.doneTodosCount`
            //     cart: 'getCart',
            //     total: 'getTotal',
            //   })
           cart(){
                return this.$store.getters.getCart;
            },
            total(){
              return this.$store.getters.getTotal;
            }
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

