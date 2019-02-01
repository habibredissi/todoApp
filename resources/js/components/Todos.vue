<template>
  <div>
    <addtask v-on:add-task="addtask"></addtask>
    <div v-bind:key="todo.id" v-for="(todo, index) in todos" v-if="todo.list_id === list_id">
      <TodoItem v-bind:todoItem="todo" v-bind:index="index" v-on:delete-task="deleteTask"/>
    </div>
  </div>
</template>

<script>
import TodoItem from "./TodoItem.vue";
import AddTask from "./AddTask.vue";

export default {
  name: "todos",
  components: {
    TodoItem,
    AddTask
  },
  computed: {
    list_id: function() {
      return this.$store.state.list_id;
    }
  },
  data() {
    return {
      todos: []
    };
  },
  created() {
    this.fetchTasks();
  },
  methods: {
    fetchTasks() {
      axios
        .get("http://188.166.159.80/api/tasks")
        .then(response => {
          this.todos = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteTask(index, id) {
      this.$delete(this.todos, index);
      axios
        .delete("http://188.166.159.80/api/tasks/" + id)
        .then(response => {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error.response.data);
        });
    },
    addtask(newTask) {
      let newTaskToAdd = axios
        .post("http://188.166.159.80/api/tasks", {
          title: newTask.title,
          done: newTask.done,
          list_id: newTask.list_id
        })
        .then(function(response) {
          return response.data;
        })
        .catch(function(error) {
          console.log(error.response.data);
        });

      newTaskToAdd.then(value => {
        this.todos = [...this.todos, value];
      });
    }
  }
};
</script>

<style>
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
body {
  font-family: Arial, Helvetica, sans-serif;
  line-height: 1.4;
}

.btn,
.form-control {
  border-radius: 0;
}
</style>
