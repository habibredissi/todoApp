<template>
  <div class="mb-1">
    <form @submit.prevent="addList">
      <input
        type="text"
        class="form-control"
        v-model="title"
        name="title"
        placeholder="Add a List..."
        required
      >
      <input type="submit" value="Add a list" class="btn btn-success disabled">
    </form>
  </div>
</template>

<script>
export default {
  name: "AddList",
  data() {
    return {
      title: ""
    };
  },
  computed: {
    list_id() {
      return this.$store.state.list_id;
    }
  },
  methods: {
    addList() {
      const newList = {
        title: this.title,
        user_id: 1
      };
      this.$emit("add_list", newList);
    }
  }
};
</script>

<style scoped>
form {
  display: flex;
}
input[type="text"] {
  flex: 10;
  padding: 5px;
}
input[type="submit"] {
  flex: 2;
}
</style>
