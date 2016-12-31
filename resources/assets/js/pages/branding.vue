<template>
<div id="page-branding">
  <div class="branding-header">
    <router-link class="branding-header-backlink" :to="{ name: 'project', params: { id: project.id } }">&laquo; {{project.name}}</router-link>
    <h1>{{ branding.name }}</h1>
    <p>{{ branding.description }}</p>
  </div>
  <div class="branding-body"> <nav class="branding-nav">
      <router-link v-for="branding in project.brandings" class="project-branding-link" :to="{ name: 'branding', params: { branding: branding.slug, id: project.id } }">{{ branding.name }}</router-link>
    </nav>
    <div class="branding-guidelines">
      <div class="branding-guideline" v-for="guideline in branding.guidelines">
        <h2>{{ guideline.name }}</h2>
        <p>{{ guideline.uses }}</p>
        <code class="branding-rule--css" v-for="rule in guideline.properties">{{rule}}</code>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data: function() {
    return {
      project: [],
      branding: [],
    }
  },
  mounted() {
    this.$http.get('api/v1/project/' + this.$route.params.id + '/' + this.$route.params.branding ).then((response) => {
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
</style>
