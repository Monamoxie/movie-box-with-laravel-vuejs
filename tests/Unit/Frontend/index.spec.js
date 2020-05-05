import { mount } from '@vue/test-utils'
import Test from '../../../resources/js/views/Test.vue'

test('it works', () => {
    expect(1 + 1).toBe(2)
})

test('should mount without crashing', () => {
    const wrapper = mount(Test)
  
    expect(wrapper).toMatchSnapshot()
})