import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

axios.defaults.baseURL = process.env.MIX_APP_API_URL

Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
        filter: 'all',
        todosLoading: true,
        newTodoLoading: false,
        todos: []
    },

    getters: {
       
    },

    mutations: {
        
    },

    actions: {
       
        retrieveTodos(context) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            context.state.todosLoading = true
            axios.get('/todos')
            .then(response => {
                context.state.todosLoading = false
                context.commit('retrieveTodos', response.data)
            })
            .catch(errors => {
                console.log(errors)
            })
        },
        
    }
})