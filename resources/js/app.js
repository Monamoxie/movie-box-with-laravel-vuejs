import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/index'
import Base from './Base'
import {store} from './store/index' 
import VeeValidate from 'vee-validate';

Vue.config.productionTip = false
Vue.use(VueRouter) 
Vue.use(VeeValidate);

require('./bootstrap');

const router = new VueRouter({
    routes,
    mode: 'history'
})

require('./router/guards')(router, store)
  
const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(Base),
})