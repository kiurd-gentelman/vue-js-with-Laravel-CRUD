<template>
        <div class="content pure-u-1 pure-u-md-21-24">
            <div class="header-small" v-if="!loading">
                <div class="items" >
                    <h1 class="subhead">Post List <router-link :to="{path:'/product-create'}"><a class="pure-button button-small button-secondary" href="post-form.html">Add New</a></router-link></h1>
                    <aside class="pure-message message-success">
                        <p><strong>SUCCESS</strong>: Success message.</p>
                    </aside>
                    <aside class="pure-message message-error">
                        <p><strong>ERROR</strong>: Error message.</p>
                    </aside>
                    <aside class="pure-message message-warning">
                        <p><strong>WARNING</strong>: Warning message.</p>
                    </aside>
                    <table class="pure-table pure-table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item , index) in items" :key="index">
                                <td>{{index}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.description}}</td>
                                <td>
                                    <a class=" btn btn-success btn-sm" href="javaScript:void(0)" v-on:click="viewDetails(item.id)">View</a>
                                    <a class=" btn btn-warning btn-sm" href="post-form.html">Edit</a>
                                    <a class=" btn btn-danger btn-sm" href="#" onclick="return confirm('Are you sure?');">Delete</a>
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
                <img src="assets/loding/loader.gif" style="margin-left: 35% ; margin-top: 10%">
            </div>

            <!--<div class="item-details">

                <button class="btn btn-success">Close</button>
            </div>-->
            <div v-if="viewDetailsVar" style="margin-top: -350px ;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="background-color: rgb(103,102,104);color: whitesmoke">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close " style="color: whitesmoke" v-on:click="viewDetailsClose()">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h4>Name :{{viewDetailsItem.name}}</h4>
                            <h4>Description :{{viewDetailsItem.description}}</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="viewDetailsClose()">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
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
            console.log(this.items);
        },
        data(){
            return{
                viewDetailsVar : false,
                loading: true,
                items:[],
                viewDetailsItem :[]
            }
        },
        props: {
            msg: String
        },
        methods:{
            fetchData(){
                let obj = this;
                axios.get('http://127.0.0.1:8000/api/v1/students')
                    .then(function (response) {
                        setTimeout(function () {
                            obj.items = response.data.students;
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
//                let id = this.data;

                console.log(data);
                axios.get("http://127.0.0.1:8000/api/v1/students"+"/"+data)
                    .then(function (response) {
                        console.log(response);
                        obj.viewDetailsItem = response.data.student;
                        // handle success
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
            }
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.item-details{
    background-color: #ff4f5a;
    height: 50%;
    width: 75%;
    position: absolute;
    margin-top: -362px;
    margin-bottom: 30%;
    margin-left: 2.5%;
}
</style>

