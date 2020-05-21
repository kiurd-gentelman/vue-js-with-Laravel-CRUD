<template>
    <div class="preloader loader" style="display: block;"> <img src="image/loader.gif"  alt="#"/></div>
</template>

<script>
    export default {
        name: 'PreLoder',
        msg: "Welcome to Your HelloVue.js App",

        props: {
            msg: String
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

