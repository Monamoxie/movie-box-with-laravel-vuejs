import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/index'
import Base from './Base'

Vue.config.productionTip = false
Vue.use(VueRouter)

const router = new VueRouter({
    routes,
    mode: 'history'
})
  
const app = new Vue({
    el: '#app',
    router,
    render: h => h(Base),
});


require('./bootstrap');