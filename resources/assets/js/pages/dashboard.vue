<template>
  <div id="page-home">
    <app-header></app-header>
    <div class="page-content">
      <h2>Dashboard</h2>
      <div class="dashboard">
        <div v-for="team in teams" class="dashboard-team">
          <h3 class="dashboard-team-title">{{team.title}}</h3>
          <div class="dashboard-project" v-for="project in team.projects">
            <h4 class="dashboard-project-title">{{project.name}}</h4>
          </div>
        </div>
        <h3>Add Another Team?</h3>
        <team-form v-model="newTeams"></team-form>
      </div>
    </div>
  </div>
</template>

<script>
Vue.component('team-form', require('../components/team-form.vue'));
export default {
  data: function() {
    return {
      currentTeams: [],
      newTeams: [],
    }
  },
  computed: {
    teams: function() {
      return this.currentTeams.concat(this.newTeams) || [];
    }
  },
  mounted() {
    this.$http.get('api/v1/projectsByTeam').then((response) => {
    //success
      console.log(response.body);
      this.currentTeams = response.body;
    }, (response) => {
      //failure
      alert('failed!'); //todo give error message
    });
  }
}
</script>
