import Vue from 'vue'
import Vuex from 'vuex'
// import axios from 'axios'



Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        accessToken: localStorage.getItem('access_token') || null
    },

    getters: {
       isLoggedIn(state) {
         return state.accessToken !== null
       }
    },


    actions: {
        loadMovies(context, payload) {
            // axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token
            return new Promise((resolve, reject) => {
                axios.post('/movies?page=' + payload.page)
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
        },
        login(context, payload) {
            return new Promise((resolve, reject) => {
                axios.post('/login',  payload)
                .then(response => {
                    resolve(response)
                })
                .catch(errors => {
                    reject(errors)
                })
            })
        },
        register(context, payload) {
            return new Promise((resolve, reject) => {
                axios.post('/register',  payload)
                .then(response => {
                    resolve(response)
                })
                .catch(errors => {
                    reject(errors)
                })
            })
        },
        setUserAccess(context, payload) {
            context.commit('mutateAccessToken', payload.access_token)
        }
    },

    mutations: {
        mutateAccessToken(state, payload) {
            state.accessToken = payload.access_token
        }
    },
    
})