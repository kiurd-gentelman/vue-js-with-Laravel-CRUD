<template>
    <div class="content pure-u-1 pure-u-md-21-24">
        <div class="header-small">

            <div class="items">
                <h1 class="subhead">Dashboard</h1>
            </div>

            <div class="pure-g">

                <div class="pure-u-1 pure-u-md-1-3">
                    <div class="column-block">
                        <div class="column-block-header column-success">
                            <h2>Users</h2>
                            <span class="column-block-info">{{totalUser}} <span>Total</span></span>
                        </div>
<!--                        <ul class="column-block-list">-->
<!--                            <li>Today <span class="buble-success button-small pull-right">100</span></li>-->
<!--                            <li>Yesterday <span class="buble-secondary button-small pull-right">1000</span></li>-->
<!--                            <li>Total <span class="buble-warning button-small pull-right">10000</span></li>-->
<!--                        </ul>-->
                    </div>
                </div>

                <div class="pure-u-1 pure-u-md-1-3">
                    <div class="column-block">
                        <div class="column-block-header column-warning">
                            <h2> Product</h2>
                            <span class="column-block-info">{{totalProduct}} <span>Total</span></span>
                        </div>
<!--                        <ul class="column-block-list">-->
<!--                            <li>Today <span class="buble-success button-small pull-right">100</span></li>-->
<!--                            <li>Yesterday <span class="buble-secondary button-small pull-right">1000</span></li>-->
<!--                            <li>Total <span class="buble-warning button-small pull-right">10000</span></li>-->
<!--                        </ul>-->
                    </div>
                </div>

                <div class="pure-u-1 pure-u-md-1-3">
                    <div class="column-block">
                        <div class="column-block-header">
                            <h2>Options</h2>
                            <span class="column-block-info">1000 <span>this month</span></span>
                        </div>
                        <ul class="column-block-list">
                            <li>Today <span class="buble-success button-small pull-right">100</span></li>
                            <li>Yesterday <span class="buble-secondary button-small pull-right">1000</span></li>
                            <li>Total <span class="buble-warning button-small pull-right">10000</span></li>
                        </ul>
                    </div>
                </div>

            </div>

<!--            <div class="pure-g">-->
<!--                <div class="pure-u-1 pure-u-md-1-3">-->
<!--                    <div class="column-block">-->
<!--                        <table class="pure-table pure-table-horizontal">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>#</th>-->
<!--                                <th>Title</th>-->
<!--                                <th>Status</th>-->
<!--                            </tr>-->
<!--                            </thead>-->

<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td>1</td>-->
<!--                                <td>Post Title 1</td>-->
<!--                                <td>Active</td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>2</td>-->
<!--                                <td>Post Title 2</td>-->
<!--                                <td>Draft</td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="pure-u-1 pure-u-md-2-3">-->
<!--                    <div class="column-block">-->
<!--                        <table class="pure-table pure-table-horizontal">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>#</th>-->
<!--                                <th>Full Name</th>-->
<!--                                <th>Email</th>-->
<!--                                <th>Role</th>-->
<!--                                <th>Status</th>-->
<!--                            </tr>-->
<!--                            </thead>-->

<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td>1</td>-->
<!--                                <td>Full Name 1</td>-->
<!--                                <td>nickname1@domain.local</td>-->
<!--                                <td>User</td>-->
<!--                                <td>Active</td>-->
<!--                            </tr>-->
<!--                            <tr>-->
<!--                                <td>2</td>-->
<!--                                <td>Full Name 2</td>-->
<!--                                <td>nickname2@domain.local</td>-->
<!--                                <td>Moderator</td>-->
<!--                                <td>Awaiting</td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

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
    export default {
        name: 'Home',

        props: {
            msg: String
        },
        data(){
            return{
                totalUser : 0,
                totalProduct: 0,
            }
        },
        methods:{
            getAllUser(){
                let self = this;
                axios.get('http://127.0.0.1:8000/api/v1/total-user')
                .then(function (response) {
                    console.log(response.data.all_users.length)
                    self.totalUser = response.data.all_users.length
                    // handle success
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })

            },
            getAllProduct(){
                let self = this;
                axios.get('http://127.0.0.1:8000/api/v1/products')
                    .then(function (response) {
                        // console.log(response.data.products.length)
                        self.totalProduct = response.data.products.length
                        // handle success
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })

            }

        },
        mounted() {
            this.getAllUser()
            this.getAllProduct()
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

