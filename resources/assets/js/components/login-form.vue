<template>
  <div class="login-form">
    <span v-if="user">{{ user.name }}</span>
    <span v-if="!user" class="login-form-toggle" v-on:click="toggleLogin">Login</span>
    <span v-if="user" class="login-form-button" v-on:click="logout">Logout</span>
    <div v-if="loginActive" v-on:click="toggleLogin" class="login-form-overlay"></div>
    <div v-if="loginActive" class="login-form-container">
      <label class="login-form-item">
        <span class="login-form-label">Email</span>
        <input v-model="email" class="login-form-input"/>
      </label>
      <label class="login-form-item">
        <span class="login-form-label">Password</span>
        <input type="password" v-model="password" class="login-form-input"/>
      </label>
      <button v-on:click="login">Login Now!</button>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      'loginActive': false,
      'email': '', 
      'password': '',
      'user': false,
    }
  },
  computed: {
    loginData: function() {
      return {
        "email": this.email,
        "password": this.password,
      }
    }
  },
  mounted() {
      this.$http.get('/api/v1/currentUser').then((response) => {
        this.user = response.body.user;
      }, (response) => {
        //failure
      });
  },
  methods: {
    toggleLogin: function() {
      this.loginActive = !this.loginActive;
    },
    login: function() {
      this.$http.post('/api/v1/authenticate', this.loginData).then((response) => {
        //success
        this.user = response.body.user;
        console.log(response.body.user);
        this.loginActive = false;
      }, (response) => {
        //failure
        console.log(response);
      });
    },
    logout: function() {
      this.$http.post('/logout', this.loginData).then((response) => {
        //success
        window.location.reload();
      }, (response) => {
        //failure
        console.log(response);
      });
    },
  }
}
</script>
