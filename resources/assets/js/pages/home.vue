<template>
  <div id="page-home">
    <app-header></app-header>
    <div class="page-content">
      <h2>Your Brand Guildelines</h2>

    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      teams: [],
      anonymous: '',
    }
  },
  mounted() {
    this.$http.get('api/v1/currentUser').then((response) => {});
  }
}
</script>
