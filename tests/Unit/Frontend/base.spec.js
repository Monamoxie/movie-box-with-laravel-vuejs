import { shallowMount, createLocalVue } from '@vue/test-utils'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import Base from '../../../resources/js/Base.vue' 
import { store } from '../../../resources/js/store/index'

const localVue = createLocalVue()
localVue.use(VueRouter)
localVue.use(Vuex)
 
const $routes = {
    path: '/',
}

const router = new VueRouter({
    $routes
})

test('Base view should mount without crashing', () => {
    const wrapper = shallowMount(Base, {
        // mocks: {
        //     $route
        // }, 
        localVue,
        router,
        store,
        stubs: ['router-link', 'router-view']
    })
}) 
