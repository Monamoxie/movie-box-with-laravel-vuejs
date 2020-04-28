import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './router/index'
import Base from './Base'
import {store} from './store/index'
import SimpleVueValidation from 'simple-vue-validator';

const Validator = SimpleVueValidation.Validator

Vue.config.productionTip = false
Vue.use(VueRouter)
Vue.use(SimpleVueValidation);

require('./bootstrap');

const router = new VueRouter({
    routes,
    mode: 'history'
})

require('./router/guards')(router)
  
const app = new Vue({
    el: '#app',
    router,
    store,
    render: h => h(Base),
})