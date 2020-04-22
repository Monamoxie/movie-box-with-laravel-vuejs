import Vue from 'vue'
import Vuex from 'vuex'
// import axios from 'axios'



Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        
    },

    getters: {
       
    },

    mutations: {
        
    },

    actions: {
        loadMovies(context) {
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
        }
    }
})