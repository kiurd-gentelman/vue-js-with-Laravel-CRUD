<template>
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <div href="#" class="profile"  >
            <img src="img_avatar.png" class="profile_image" alt="Avatar" style="">
            <div style="text-align:center" class="profile_name"><h4>ImtiAz</h4></div>
        </div>
        <div class="label">
            <a href="#">Dashboard</a>
            <a href="#">Products</a>
            <a href="#">Category</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Header',

        props: {
            msg: String
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

