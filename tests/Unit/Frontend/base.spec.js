import { shallowMount } from '@vue/test-utils'
import Test from '../../../resources/js/Test.vue'

test('it works', () => {
    expect(1 + 1).toBe(2)
})

test('should mount without crashing', () => {
    const wrapper = shallowMount(Test) 
    console.log(wrapper) 
    // expect(wrapper).toMatchSnapshot()
}) 