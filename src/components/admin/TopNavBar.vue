<template>
    <div class="openbtn" >
        <div class="topnav">
            <a onclick="openNav()">☰</a>
            <a clnss="active" href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TopNavBar',

        props: {
            msg: String
        },

    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

