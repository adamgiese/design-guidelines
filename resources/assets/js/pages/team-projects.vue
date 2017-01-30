<template>
<div id="page-projects">
  <app-header></app-header>
  <div class="page-content">
    <router-link class="project-backlink" :to="{ name: 'teams' }">&laquo; Back To All Teams</router-link>
    <h1>Projects</h1>
    <div class="projects" v-if="projects">
      <router-link class="project" v-for="project in projects" :to="{ name: 'project', params: { id: project.id } }">
        <h2 class="project-name">{{ project.name }}</h2>
        <span v-if="project.lastUpdated" class="project-last-updated">Last Updated {{ project.lastUpdated }}</span>
      </router-link>
    </div>
    <div class="projects-form">
      <label>
        Project Name:
        <input v-model="newProjectName" />
      </label>
      <label>
        Project Subtitle:
        <input v-model="newProjectSubtitle" />
      </label>
      <label>
        Project Description:
        <textarea v-model="newProjectDescription" placeholder="Project Description"></textarea>
      </label>
      <div class="project-errors">
        <div class="error" v-for="error in createProjectErrors">
          <span class="error-message" v-for="message in error">{{message}}</span>
        </div>
      </div>
      <button v-on:click="createProject">Create Project</button>
    </div>
  </div>
</div>
</template>

<script>
import VueRouter from 'vue-router';
Vue.component('app-header', require('../components/app-header.vue'));

export default {
  data: function() {
    return {
      projects: [],
      createTeamErrors: [],
    }
  },
  computed: {
    projectData: function() {
      return {
        "name": this.newProjectName,
        "description": this.newProjectDescription,
        "subtitle": this.newProjectSubtitle,
        "teamID": this.$route.params.id
      }
    }
  },
  mounted() {
    this.$http.get('api/v1/team/' + this.$route.params.id + '/projects').then((response) => {
    //success
      console.log(response);
      this.projects = response.data;
    }, (response) => {
      //failure
      console.log(response.body);
    });
  },  
  methods: {
    createProject: function() {
      this.$http.post('/api/v1/project', this.projectData).then((response) => {
        //success
        console.log(response);
        this.projects.push(this.projectData);
      }, (response) => {
        //failure
        console.log('failure to create project!');
        this.createprojectErrors = response.body;
        console.log(response.body);
      });
    }
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
