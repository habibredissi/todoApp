<template>
  <div>
    <navbar></navbar>
    <div class="container mt-4">
      <div
        class="alert alert-warning"
        v-bind:class="{ 'd-none': !alert }"
        role="alert"
      >Les deux mots de passe doivent correspondent</div>
      <!-- form card login -->
      <div class="card rounded-0">
        <div class="card-header">
          <h3 class="mb-0">Register</h3>
        </div>
        <div class="card-body">
          <form class="form" @submit.prevent="register">
            <div class="form-group">
              <label for="uname1">Username</label>
              <input
                type="text"
                class="form-control form-control-lg rounded-0"
                name="name"
                v-model="name"
                required
                autocomplete="username"
              >
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input
                type="text"
                class="form-control form-control-lg rounded-0"
                v-model="email"
                name="email"
                required
                autocomplete="email"
              >
            </div>
            <div class="form-group">
              <label>Password</label>
              <input
                name="password"
                type="password"
                v-model="password"
                class="form-control form-control-lg rounded-0"
                required
                autocomplete="current-password"
              >
            </div>
            <div class="form-group">
              <label>Confirm password</label>
              <input
                name="confirm_password"
                type="password"
                v-model="confirm_password"
                class="form-control form-control-lg rounded-0"
                required
                autocomplete="current-password"
              >
            </div>
            <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Register</button>
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
  name: "Register",
  data() {
    return {
      name: "",
      email: "",
      password: "",
      confirm_password: "",
      alert: false,
      msg: ""
    };
  },
  methods: {
    register() {
      if (this.password !== this.confirm_password) {
        this.alert = true;
      } else {
        this.alert = false;

        let register = axios
          .post("/api/register", {
            name: this.name,
            email: this.email,
            password: this.password
          })
          .then(function(response) {
            return response.status;
          })
          .catch(function(error) {
            console.log(error.response.data);
          });

        register.then(status => {
          if (status == 201) {
            this.$router.push("/login");
          }
        });
      }
    }
  }
};
</script>

<style>
</style>
