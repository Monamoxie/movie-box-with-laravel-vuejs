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
        loadMovies(context, payload) {
            // axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            return new Promise((resolve, reject) => {
                axios.get('/movies?page=' + payload.page)
                .then(response => {
                    resolve(response)
                })
                .catch(errors => {
                    reject(errors)
                })
            })
        },
        movieDetails(context, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/movies/' + payload.id)
                .then(response => {
                    resolve(response)
                })
                .catch(errors => {
                    reject(errors)
                })
            })
        }
    }
})