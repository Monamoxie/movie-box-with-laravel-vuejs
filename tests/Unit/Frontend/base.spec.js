import { shallowMount } from '@vue/test-utils'
import Base from '../../../resources/js/Base.vue' 
 
 
const $route = {
    path: '/',
}

test('it works', () => {
    expect(1 + 1).toBe(2)
})

test('Base view should mount without crashing', () => {
    const wrapper = shallowMount(Base, {
        mocks: {
            $route
        }, 
        stubs: ['router-link', 'router-view'] 
    })
}) 
