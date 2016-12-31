<template>
<div id="page-projects">
<app-header></app-header>
<h1>Projects</h1>
<div class="projects" v-if="projects">
  <router-link class="project" v-for="project in projects" :to="{ name: 'project', params: { id: project.id } }">
    <h2 class="project-name">{{ project.name }}</h2>
    <span v-if="project.lastUpdated" class="project-last-updated">Last Updated {{ project.lastUpdated }}</span>
  </router-link>
</div>
</div>
</template>

<script>
import VueRouter from 'vue-router';
Vue.component('app-header', require('../components/app-header.vue'));

export default {
  data: function() {
    return {
      projects: []
    }
  },
  mounted() {
    this.$http.get('api/v1/projects').then((response) => {
    //success
      this.projects = response.data;
    }, (response) => {
      //failure
      alert('failed!'); //todo give error message
    });
  }
}

</script>

<style lang="css" scoped>
.projects {
  list-style: none;
  max-width: 1024px;
  margin: 0 auto;
  padding: 0;
}

.project {
  background: #ddd;
  color: black;
  display: flex;
  margin-top: 1em;
  padding: 1em;
  text-align: left;
  text-decoration: none;
}
.project-name {
  border: none;
  margin: 0;
}
.project-last-updated {
  align-self: center;
  margin-left: auto;
}
.project:hover {
  background: #ccc;
}
.project:nth-child(3n) {
  margin-right: 0;
}

</style>
