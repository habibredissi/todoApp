<template>
  <div>
    <div class="todo-item">
      <button
        class="del"
        @click="$emit('delete-task', index, todoItem.id)"
        v-bind:class="{'hide':editing}"
      >X</button>
      <div v-if="!editing">
        <input type="checkbox" v-on:change="markDone" v-bind="{'checked':todoItem.done}">
        <span
          class="text"
          @click="enableEditing"
          v-bind:class="{'is-complete':todoItem.done}"
        >{{todoItem.title}} -</span>
        <small class="text-muted" @click="enableEditing">Click to edit</small>
      </div>
      <div v-if="editing">
        <div class="input-group">
          <input v-model="tempValue" class="form-control mx-2">
          <span class="input-group-btn">
            <button class="btn btn-secondary" @click="disableEditing">Cancel</button>
            <button class="btn btn-success" @click="saveEdit">Save</button>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TodoItem",
  props: ["todoItem", "index"],
  data() {
    return {
      tempValue: null,
      editing: false
    };
  },
  created() {},
  methods: {
    markDone() {
      this.todoItem.done = !this.todoItem.done;
      axios
        .put("/api/tasks/" + this.todoItem.id, {
          title: this.todoItem.title,
          done: this.todoItem.done
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(function(error) {
          console.log(error.response.data);
        });
    },
    enableEditing() {
      this.tempValue = this.todoItem.title;
      this.editing = true;
    },
    disableEditing() {
      this.tempValue = null;
      this.editing = false;
    },
    saveEdit() {
      this.todoItem.title = this.tempValue;
      this.disableEditing();

      // However we want to save it to the database
      axios
        .put("/api/tasks/" + this.todoItem.id, {
          title: this.todoItem.title,
          done: this.todoItem.done
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(function(error) {
          console.log(error.response.data);
        });
    }
  }
};
</script>

<style scoped>
.todo-item {
  background: #f4f4f4;
  padding: 10px;
  border-bottom: 1px #ccc dotted;
}
.is-complete {
  text-decoration: line-through;
}
.del {
  background: #ff0000;
  color: #fff;
  border: none;
  padding: 0px 5px;
  border-radius: 50%;
  cursor: pointer;
  float: right;
}

.hide {
  display: none;
}
</style>
