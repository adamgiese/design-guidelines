<template>
<div id="page-project">
  <app-header></app-header>
  <div class="project-body">
    <div class="project-nav-container">
      <nav class="project-nav">
        <router-link v-for="branding in project.brandings" class="project-branding-link" :to="{ name: branding.slug }">{{ branding.name }}</router-link>
      </nav>
    </div>
    <div class="project-content">
      <router-link class="project-backlink" :to="{ name: 'projects' }">&laquo; Back To All Projects</router-link>
      <h1 class="project-title">{{project.name}}</h1>
      <h2 class="project-subtitle">{{project.subtitle}}</h2>
      {{project.description}}
    </div>
  </div>
</div>
</template>

<script>
Vue.component('app-header', require('../components/app-header.vue'));
export default {
  data: function() {
    return {
      project: []
    }
  },
  mounted() {
    this.$http.get('api/v1/project/' + this.$route.params.id ).then((response) => {
    //success
      console.log(response.body);
      this.project = response.body;
    }, (response) => {
      //failure
      alert('failed!'); //todo give error message
    });
  }
}
</script>

<style lang="css" scoped>
  .project-header-backlink {
    display: block;
    margin-bottom: 1em;
  }
  .project-title {
    margin-bottom: 0;
  }
  .project-subtitle {
    text-transform: uppercase;
    font-size: 1rem;
    margin-bottom: 2rem;
  }
  .project-nav a {
  }
  .project-nav a:hover {
    background-color: #ddd;
  }
  .project-overview {
    flex: 0 75%;
  }
</style>
