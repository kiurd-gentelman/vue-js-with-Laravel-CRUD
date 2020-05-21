<template>
  <div class="hello">
    <h1>I am From Test World</h1>
    <h1>I am From Test World</h1>
    <h4>{{msg2}}</h4>
  </div>
</template>

<script>
export default {
  name: 'TestWorld',
    msg2 : "Welcome to Your TestVue.js App",
  props: {
      msg2: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
