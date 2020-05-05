module.exports = {
  // preset: '@vue/cli-plugin-unit-jest/presets/no-babel',
  testRegex: 'tests/Unit/Frontend/.*.spec.js$',
  moduleFileExtensions: [
    'js',
    'json',
    'vue'
  ],
  'transform': {
    '^.+\\.js$': '<rootDir>/node_modules/babel-jest',
    '.*\\.(vue)$': '<rootDir>/node_modules/vue-jest'
  },
}
