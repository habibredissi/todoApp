<template>
  <div>
    <h3>Select one of your lists</h3>
    <div v-for="(list, index) in lists" v-bind:key="list.id">
      <div class="list-item" @click="loadList(list.id)">
        {{list.title}}
        <img
          src="../img/rubbish-bin.png"
          class="deleteIcon"
          @click="deleteListItem(list.id, index)"
        >
      </div>
    </div>
    <AddList v-on:add_list="addlist"></AddList>
  </div>
</template>

<script>
import AddList from "./AddList.vue";
export default {
  name: "Lists",
  components: {
    AddList
  },
  data() {
    return {
      lists: []
    };
  },
  computed: {
    list_id() {
      return this.$store.state.list_id;
    }
  },
  created() {
    this.fetchTasks();
  },
  methods: {
    fetchTasks() {
      axios
        .get("/api/lists")
        .then(response => {
          this.lists = response.data;
          this.$store.commit("changeListId", this.lists[0].id);
        })
        .catch(error => {
          console.log(error);
        });
    },
    loadList(listId) {
      this.$store.commit("changeListId", listId);
    },
    addlist(newList) {
      let list2add = axios
        .post("/api/lists", {
          title: newList.title,
          user_id: newList.user_id
        })
        .then(function(response) {
          return response.data;
        })
        .catch(function(error) {
          console.log(error.response.data);
        });

      list2add.then(value => {
        this.lists = [...this.lists, value];
      });
    },
    deleteListItem(id, index) {
      this.$delete(this.lists, index);
      axios
        .delete("/api/lists/" + id)
        .then(response => {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error.response.data);
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
.list-item {
  padding: 10px;
  background: darkgrey;
  color: white;
  font-weight: bold;
  letter-spacing: 2px;
  margin-top: 2px;
}
.deleteIcon {
  float: right;
}
</style>
