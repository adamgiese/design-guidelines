<template>
<div id="page-branding">
  <app-header></app-header>
  <div class="project-body"> 
    <div class="project-nav-container">
      <nav class="project-nav">
        <router-link v-for="branding in project.brandings" class="project-branding-link" :to="{ name: branding.slug }">{{ branding.name }}</router-link>
      </nav>
    </div>
    <div class="project-content">
      <router-link class="project-backlink" :to="{ name: 'project', params: { id: project.id } }">&laquo; {{project.name}}</router-link>
      <h1>Fonts</h1>
      <font-family v-bind:fontFamily="font" v-for="font in typography.fonts"></font-family>
    </div>
  </div>
</div>
</template>

<script>
Vue.component('font-family', require('../components/font-family.vue'));

export default {
  data: function() {
    return {
      project: [],
      typography: [],
    }
  },
  mounted() {
    this.$http.get('api/v1/project/' + this.$route.params.id + '/fonts').then((response) => {
    //success
      this.project = response.body.project;
      this.typography = response.body.branding;
    }, (response) => {
      //failure
      alert('failed!'); //todo give error message
    });
  }
}

</script>
