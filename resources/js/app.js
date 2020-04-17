import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/index'
import App from './views/App'

Vue.config.productionTip = false
Vue.use(VueRouter)

const router = new VueRouter({
    routes,
    mode: 'history'
})
  
const app = new Vue({
    el: '#app',
    router,
    render: h => h(App),
});


require('./bootstrap');