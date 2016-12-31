<template>
<nav class="app-nav">
  <ul class="app-nav-list">
    <li><router-link :to="{ name: 'home' }">Home</router-link></li>
    <li><router-link :to="{ name: 'projects' }">Projects</router-link></li>
  </ul>
</nav>
</template>

<script>
import VueRouter from 'vue-router';

export default {
  mounted() {
    console.log('App Nav mounted.')
  }
}
</script>
