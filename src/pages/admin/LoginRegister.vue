<template>
    <div id="main" class="pure-g">
        <div class="sidebar pure-u-1 pure-u-md-1-2">
            <div class="header-large">
                <h1>Pure Admin</h1>
                <h2>Simple Admin Panel For Everyone</h2>

                <nav class="nav">
                    <ul>
                        <li>
                            <a class="pure-button active" href="javaScript:void(0)"><router-link :to="{path:'login'}">Login</router-link></a>
                            <a class="pure-button" href="javaScript:void(0)"><router-link :to="{path:'register'}">Register</router-link></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <router-view></router-view>

       
    </div>
</template>

<script>
  
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>

