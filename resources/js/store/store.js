import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        list_id: null,
    },
    mutations: {
        changeListId: (state, listId) => {
            state.list_id = listId
        }
    }
})
