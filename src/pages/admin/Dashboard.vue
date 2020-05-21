<template>
    <div>
        <div id="layout" class="pure-g">
            <NavBar/>
            
            <router-view></router-view>
        </div>
    </div>

</template>

<script>
    import NavBar from '../../components/admin/NavBar.vue'
    export default {
        name: 'Dashboard',
        data(){
            return {
                hello: true,
            }
        },
        components:{
            NavBar
        },
        mounted(){
            let token = localStorage.getItem('token');
            if(!token){
                this.$router.push({path:'/login-register'});
            }

        },
        props: {
            msg: String
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

