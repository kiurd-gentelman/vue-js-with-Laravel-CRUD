<template>
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
                <a class="buble-warning button-small text-white" style="text-decoration:none" href="javaScript:void(0)">Add to cart</a>
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
</template>
<script>
import axios from 'axios';
export default {
    name: "Allproduct",
    data() {
        return {
        items: [],
        loading:true,
        };
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
    }
  }
};

</script>