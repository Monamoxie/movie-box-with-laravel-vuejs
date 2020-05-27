import { shallowMount } from '@vue/test-utils'
import Base from '../../../resources/js/Base.vue'

test('it works', () => {
    expect(1 + 1).toBe(2)
})

test('should mount without crashing', () => {
    const wrapper = shallowMount(Base)  
    console.log(wrapper)  
    // expect(wrapper).toMatchSnapshot()
}) 