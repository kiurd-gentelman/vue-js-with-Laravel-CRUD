<template>
    <div class="sidebar pure-u-1 pure-u-md-3-24">
        <div id="menu">
            <div class="pure-menu">
                <p class="pure-menu-heading">
                    {{PN}}
                    <a href="login.html" class="pure-button button-xxsmall">OUT &raquo;</a>
                </p>
                <ul class="pure-menu-list">
                    <li class="pure-menu-selected">
                        <a href="javaScript:void(0)" class="pure-menu-link"><router-link to="/dashboard/home">Dashboard</router-link></a>
                    </li>
                    <li>
                        <a href="javaScript:void(0)" class="pure-menu-link"><router-link to="/dashboard/products">Product List</router-link></a>
                    </li>
                    <li>
                        <a href="javaScript:void(0)" class="pure-menu-link"><router-link to="/dashboard/product-create">Create Product</router-link></a>
                    </li>
                    <li class="menu-item-divided">
                        <a href="javascript:void(0)" class="pure-menu-link"><router-link :to="{name: 'shop'}">View Shop</router-link></a>
                    </li>
                    <!-- <li>
                        <a href="option-form.html" class="pure-menu-link">Option Form</a>
                    </li>
                    <li class="menu-item-divided">
                        <a href="profile.html" class="pure-menu-link">Profile</a>
                    </li> -->
                    <li class="menu-item-divided">
                        <a href="javaScript:void(0)" class="pure-menu-link" @click="logoutNow()">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'NavBar',

        props: {
            msg: String
        },
        data(){
            return{
                projectName : '',
            }
        },
        methods:{
            logoutNow(){
                localStorage.setItem('token','');
                this.projectName = this.$router.push({path:'/'});
            }
        },
        computed:{
            PN(){
                return this.$store.getters.getName;
            }
        }

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

