import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/index'
import Base from './views/base/Base'

const router = new VueRouter({
    routes,
    mode: 'history'
})
  
const app = new Vue({
    el: '#app',
    router,
    render: h => h(Base),
    template: '<Base/>'
});


require('./bootstrap');