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
      <h1>Logos</h1>
      <div class="icon-group" v-for="iconGroup in icons">
        <h2>{{iconGroup.name}}</h2>
        <div v-bind:class="iconGroup.display" class="icons">
          <div class="icon" v-for="icon in iconGroup.icons">
            <h3>{{icon.name}}</h3>
            <img v-bind:src="icon.src" />
          </div>
        </div>
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
      icons: [],
    }
  },
  mounted() {
    this.$http.get('api/v1/project/' + this.$route.params.id + '/logos').then((response) => {
    //success
      console.log(response);
      this.project = response.body.project;
      this.icons = response.body.icons;
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
  .icons.compact {
  }
  .icons.compact .icon {
    display: inline-block;
    vertical-align: top;
    padding: 1rem;
  }
  .icons.compact .icon img {
    max-height: 52px;
  }

</style>
