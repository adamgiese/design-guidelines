<template>
<div class="team-form">
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
</template>

<script>
export default {
  data: function() {
    return {
      createTeamErrors: [],
      anonymous: '',
    }
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
        this.$emit('input', this.teamData);
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
