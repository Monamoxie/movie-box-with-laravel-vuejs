import { shallowMount, createLocalVue  } from '@vue/test-utils'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import Home from '../Home.vue' 
import { store } from '../../store/index'
 
const localVue = createLocalVue()
localVue.use(VueRouter)
localVue.use(Vuex)

const $routes = [{
    path: '/',
    component: Home
}]

const router = new VueRouter({
    $routes
})
 
test('Home view should mount without crashing', () => {
    const wrapper = shallowMount(Home, {
        localVue,
        router,
        store,
        stubs: ['router-link', 'router-view'],
        setData: {
            topBannerBackgroundImage: 'background-image:url("../../../images/1.jpeg")',
            bottomBannerBackgroundImage: 'background-image: url("../../../images/banner22.jpg")',
            movies: [],
            paginationParam: {},
            serverResponse: [],  
            processing: false
        },
    }) 
})  
 