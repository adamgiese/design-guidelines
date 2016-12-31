<template>
<div id="page-branding">
  <app-header></app-header>
  <div class="project-body"> 
    <div class="project-nav-container">
      <nav class="project-nav">
        <router-link v-for="branding in project.brandings" class="project-link" :to="{ name: branding.slug }">{{ branding.name }}</router-link>
      </nav>
    </div>
    <div class="project-content">
      <router-link class="project-backlink" :to="{ name: 'project', params: { id: project.id } }">&laquo; {{project.name}}</router-link>
      <h1>Colors</h1>
      <p>Brief description regardings color...</p>
      <div v-for="spectrum in spectrums" class="spectrum">
        <h2 class="spectrum-name">{{ spectrum.name }}</h2>
        <color v-bind:color="color" v-for="color in spectrum.colors"></color>
      </div>
    </div>
  </div>
</div>
</template>

<script>
Vue.component('color', require('../components/color.vue'));

export default {
  data: function() {
    return {
      project: [],
      spectrums: [],
    }
  },
  mounted() {
    this.$http.get('api/v1/project/' + this.$route.params.id + '/colors').then((response) => {
    //success
      console.log(response);
      this.project = response.body.project;
      this.spectrums = response.body.spectrums;
    }, (response) => {
      //failure
      alert('failed!'); //todo give error message
    });
  }
}

</script>

<style lang="css" scoped>
  .branding-body {
    display: flex;
    flex-direction: row;
  }
  .branding-nav {
    flex: 0 25%;
  }
  .branding-nav a {
    display: block;
    text-decoration: none;
    padding: .5em 1em;
    max-width: calc(100% - 2em);
    margin-bottom: .25em;
    background-color: #eee;
  }
  .branding-nav a:hover {
    background-color: #ddd;
  }
  .branding-rule--css {
    display: block;
  }
  .branding-guideline {
    margin-top: 2rem;
  }
  .branding-guideline:first-child {
    margin-top: 0;
  }
  .branding-font-title {
    margin-top: 1em;
  }
  .branding-content {
    flex: 0 75%;
  }
  .color-swatch {
    width: 40px;
    height: 40px;
    border: 1px solid black;
    border-radius: 1em;
  }
</style>
