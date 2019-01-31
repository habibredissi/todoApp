<template>
  <div>
    <navbar></navbar>
    <div class="container mt-4">
      <!-- form card login -->
      <div class="card rounded-0">
        <div class="card-header">
          <h3 class="mb-0">Login</h3>
        </div>
        <div class="card-body">
          <form class="form" @submit.prevent="login">
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="text"
                class="form-control form-control-lg rounded-0"
                name="email"
                v-model="username"
                required
                autocomplete="email"
              >
            </div>
            <div class="form-group">
              <label>Password</label>
              <input
                type="password"
                class="form-control form-control-lg rounded-0"
                name="password"
                v-model="password"
                required
                autocomplete="current-password"
              >
              <div class="invalid-feedback">Enter your password too!</div>
            </div>
            <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
          </form>
        </div>
        <!--/card-block-->
      </div>
      <!-- /form card login -->
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      username: "",
      password: ""
    };
  },
  methods: {
    login() {
      let data = {
        grant_type: "password",
        client_id: 2,
        client_secret: "z4Ik0dbrDuGRTj2oYyl1vUyKTrCw7IMTH2jOIrPU",
        username: this.username,
        password: this.password
      };

      let payload = axios
        .post("/oauth/token", data)
        .then(function(response) {
          return response.data;
        })
        .catch(function(error) {
          console.log(error.response.data);
        });

      payload.then(data => {
        this.$auth.setToken(data.access_token, data.expires_in + Date.now());
        this.$router.push("/");
      });
    }
  }
};
</script>

<style>
</style>
