<template>
  <div id="page-team">
    <app-header></app-header>
    <div class="page-content">
      <div v-if="anonymous">
        <h2>Please Login To View This Page</h2>
      </div>
      <div v-if="!anonymous">
        <div class="teams">
          <router-link v-for="team in teams" :to="{ name: 'teamProjects', params: { id: team.id } }">
            <h2>{{team.title}}</h2>
          </router-link>
        </div>
        <div v-if="!teams">There are no teams! Created on below!</div>
        <div class="teams-form">
          <label>
            Team Name:
            <input v-model="newTeamName" />
          </label>
          <label>
            Team Description:
            <textarea v-model="newTeamDescription" placeholder="Team Description"></textarea>
          </label>
          <div class="team-errors">
            <div class="error" v-for="error in createTeamErrors">
              <span class="error-message" v-for="message in error">{{message}}</span>
            </div>
          </div>
          <button v-on:click="createTeam">Create Team</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueRouter from 'vue-router';

export default {
  data: function() {
    return {
      teams: [],
      createTeamErrors: [],
      anonymous: '',
    }
  },
  mounted() {
    this.$http.get('api/v1/teams').then((response) => {
    //success
      console.log(response.body);
      if ( response.body.success ) {
        this.teams = response.body.teams;
        this.anonymous = false;
      } else {
        this.anonymous = true;
      }
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
        this.teams.push(this.teamData);
      }, (response) => {
        //failure
        console.log('failure to create team!');
        this.createTeamErrors = response.body;
        console.log(response.body);
      });
    }
  }
}
</script>
