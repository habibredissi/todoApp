<template>
  <div class="mb-1">
    <form @submit.prevent="addTodo">
      <input
        type="text"
        class="form-control"
        v-model="title"
        name="title"
        placeholder="Add Todo..."
        required
      >
      <input type="submit" value="Add a task" class="btn btn-primary">
    </form>
  </div>
</template>

<script>
export default {
  name: "AddTask",
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
    addTodo() {
      const newTask = {
        title: this.title,
        done: 0,
        list_id: this.list_id
      };
      this.$emit("add-task", newTask);
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
