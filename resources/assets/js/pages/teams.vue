<template>
  <div id="page-team">
    <app-header></app-header>
    <div class="page-content">
    <h2 v-for="team in teams">{{team.title}}</h2>
    </div>
    <div class="teams-form">
      <label>
        Team Name:
        <input v-model="newTeamName" />
      </label>
      <label>
        Team Description:
        <textarea v-model="newTeamDescription" placeholder="Team Description"></textarea>
      </label>
      <button v-on:click="createTeam">Create Team</button>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      teams: []
    }
  },
  mounted() {
    this.$http.get('api/v1/teams').then((response) => {
    //success
      this.teams = response.data;
      console.log(response.data);
    }, (response) => {
      //failure
      alert('failed!'); //todo give error message
    });
  },
  computed: {
    teamData: function() {
      return {
        "title": this.newTeamName,
        "description": this.newTeamDescription
      }
    }
  },
  methods: {
    createTeam: function() {
      this.$http.post('/api/v1/team', this.teamData).then((response) => {
        //success
        console.log(response);
      }, (response) => {
        //failure
        console.log(response);
      });
    }
  }
}
</script>
