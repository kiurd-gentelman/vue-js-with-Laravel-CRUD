\<template>
    <div class="row">
        <div class="column" style="background-color:#aaa;">
            <div class="card">
                <img src="img_avatar.png" alt="Avatar" style="width:100%">
                <div class="container">
                    <h4><b>John Doe</b></h4>
                    <p>Architect & Engineer</p>
                </div>
            </div>
        </div>
        <div class="column" style="background-color:#bbb;">
            <h2>Column 2</h2>
            <p>Some text..</p>
        </div>
        <div class="column" style="background-color:#ccc;">
            <h2>Column 3</h2>
            <p>Some text..</p>
        </div>
        <div class="column" style="background-color:#ddd;">
            <h2>Column 4</h2>
            <p>Some text..</p>
        </div>
        <div class="column" style="background-color:#ddd;">
            <h2>Column 4</h2>
            <p>Some text..</p>
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

