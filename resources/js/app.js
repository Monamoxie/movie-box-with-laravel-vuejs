import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/index'
import Base from './Base'
import {store} from './store/index'

Vue.config.productionTip = false
Vue.use(VueRouter)

require('./bootstrap');

const router = new VueRouter({
    routes,
    mode: 'history'
})
  
const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(Base),
})