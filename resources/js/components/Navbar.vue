<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary container">
    <a class="navbar-brand" href="#">Todo List App</a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarColor01"
      aria-controls="navbarColor01"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">
            Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item" v-if="!this.$auth.isAuthenticated()">
          <router-link to="/login" class="nav-link">Login</router-link>
        </li>
        <li class="nav-item" v-if="!this.$auth.isAuthenticated()">
          <router-link to="/register" class="nav-link">Register</router-link>
        </li>
        <li class="nav-item" v-if="this.$auth.isAuthenticated()" @click="logout">
          <a href="#" class="nav-link">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
</template>

// <script>
export default {
  name: "Navbar",
  methods: {
    logout() {
      this.$auth.destroyToken();
      this.$router.push("/login");
    }
  }
};
</script>
