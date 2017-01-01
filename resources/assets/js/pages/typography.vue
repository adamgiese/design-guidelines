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
      <h1>Typography</h1>
      <typography-pattern v-bind:pattern="typographyPattern" v-for="typographyPattern in branding.typographyPatterns"></typography-pattern>
    </div>
  </div>
</div>
</template>

<script>
Vue.component('font-family', require('../components/font-family.vue'));
Vue.component('typography-pattern', require('../components/typography-pattern.vue'));

export default {
  data: function() {
    return {
      project: [],
      branding: [],
    }
  },
  mounted() {
    this.$http.get('api/v1/project/' + this.$route.params.id + '/typography').then((response) => {
    //success
      this.project = response.body.project;
      this.branding = response.body.branding;
    }, (response) => {
      //failure
      alert('failed!'); //todo give error message
    });
  }
}

</script>
