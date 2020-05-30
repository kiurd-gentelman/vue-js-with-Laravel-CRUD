<template>

        <div class="content pure-u-1 pure-u-md-21-24">
            <Modal :productId="setProductID" v-if="modelShow" @closeModal="modelShow = false" @refresh="refresh"></Modal>
            <div v-if="viewDetailsVar" style="position:absolute ; margin-top:5%;width:80%">
                <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" style="background-color: rgb(103,102,104);color: whitesmoke">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close " style="color: whitesmoke" v-on:click="viewDetailsClose()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <h5> Image :</h5><img :src = "'http://127.0.0.1:8000/product/images/'+viewDetailsItem.image" class="rounded mx-auto a-block img-thumbnail" style="height: 70px; width: 70px" >
                            <h4>Name :{{viewDetailsItem.name}}</h4>
                            <div class="row">
                                <div class="col-md-6"><h4>Quantity :{{viewDetailsItem.quantity}}</h4></div>
                                <div class="col-md-6"><h4>Price :{{viewDetailsItem.price}}</h4></div>
                            </div>
                            <h4>Category :{{viewDetailsItem.category}}</h4>
                            <h4>Description :{{viewDetailsItem.description}}</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="viewDetailsClose()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-small" v-if="!loading">
                <div class="items" >
                    <h1 class="subhead">Post List <router-link :to="{path:'/dashboard/product-create'}"><a class="pure-button button-small button-secondary" href="post-form.html">Add New</a></router-link></h1>
                   <!-- <aside class="pure-message message-success">
                        <p><strong>SUCCESS</strong>: Success message.</p>
                    </aside>
                    <aside class="pure-message message-error">
                        <p><strong>ERROR</strong>: Error message.</p>
                    </aside>
                    <aside class="pure-message message-warning">
                        <p><strong>WARNING</strong>: Warning message.</p>
                    </aside>-->
                    <table class="pure-table pure-table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item , index) in items" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{item.name}}</td>
                                <td><img :src = "'http://127.0.0.1:8000/product/images/'+ item.image" class="rounded mx-auto d-block img-thumbnail" style="height: 70px; width: 70px" ></td>
                                <td>{{item.category}}</td>
                                <td>{{item.quantity}}</td>
                                <td>{{item.price}}</td>
                                <td>{{item.description}}</td>
                                <td>
                                    <a class=" btn btn-success btn-sm" href="javaScript:void(0)" v-on:click="viewDetails(item.id)">View</a>
                                    <a class=" btn btn-warning btn-sm" href="post-form.html" @click.prevent="productEdit(item.id)" >Edit</a>
                                    <a class=" btn btn-danger btn-sm" href="#" @click.prevent="productDelete(item.id)">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="navigation">
                    <div class="pure-button-group">
                        <a href="#" class="pure-button">Prev</a>
                        <a href="#" class="pure-button">Next</a>
                    </div>
                </div>

                <div class="footer">
                    <div class="pure-menu pure-menu-horizontal">
                        <ul>
                            <li class="pure-menu-item "><a href="http://purecss.io/" class="pure-menu-link">PURE CSS</a></li>
                            <li class="pure-menu-item"><a href="http://fikiruretgeci.com" class="pure-menu-link">FIKIR URETGECI</a></li>
                            <li class="pure-menu-item"><a href="http://pure-themes.com" class="pure-menu-link">PURE THEMES</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="header-small" v-else>
                <img src="/assets/loading/loader.gif" style="margin-left: 35% ; margin-top: 10%">
            </div>
            <!--<div class="item-details">
                <button class="btn btn-success">Close</button>
            </div>-->
        
        </div>

</template>

<script>
    import axios from 'axios';
    export default {
        /*data: () => ({

        }),*/
        name: 'Product',
        mounted(){
            this.fetchData();
        },
        data(){
            return{
                viewDetailsVar : false,
                loading: true,
                items:[],
                viewDetailsItem :[],
                setProductID : '',
                modelShow :false
            }
        },
        props: {
            msg: String
        },
        methods:{
            productEdit(id){
                let obj = this;
                obj.setProductID = id;
                obj.modelShow = true;
            },
            fetchData(){
                let obj = this;
                 obj.loading = true;
                axios.get('http://127.0.0.1:8000/api/v1/products')
                    .then(function (response) {
                        setTimeout(function () {
                            obj.items = response.data.products;
//                        console.log(response);
                            obj.loading = false;
                        },3000)
                        // handle success
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            viewDetails(data){
                let obj = this;
                obj.viewDetailsVar = false;
//                let id = this.data;
                obj.loading =  true;
                axios.get("http://127.0.0.1:8000/api/v1/product"+"/"+data)
                    .then(function (response) {
                        console.log(response);
                        obj.viewDetailsItem = response.data.product;
                        // handle success
                        obj.loading =  false;
                        obj.viewDetailsVar = true;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
            },
            viewDetailsClose(){
                let obj = this;
                obj.viewDetailsVar = false;
            },
            productDelete(data){
                let obj = this;
//                let id = this.data;
                obj.loading =  true;
                let v = confirm('Are you sure to delete this item?');
                if (v == true){
                    axios.get("http://127.0.0.1:8000/api/v1/product/delete"+"/"+data)
                        .then(function (response) {
                            console.log(response);
                            if (response.data.error){
                                obj.$iziToast.error({
                                    title: 'Error',
                                    message: response.data.message,
                                });
                                obj.loading =  false;
                            }else{

                                obj.fetchData();
                                obj.$iziToast.error({
                                    title: 'success',
                                    image: '/assets//image/profile-image.jpeg',
                                    imageWidth: 50,
                                    position: 'topCenter',
                                    message: response.data.message,
                                });

                                obj.loading =  false;
                            }
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })

                }
            },
            refresh(){
                let obj = this;
                console.log('ashtese');
                obj.modelShow = false;
                obj.fetchData();
            }
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
/* .item-details{
    background-color: #ff4f5a;
    height: 50%;
    width: 75%;
    position: absolute;
    margin-top: -362px;
    margin-bottom: 30%;
    margin-left: 2.5%;
} */
</style>

