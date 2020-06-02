module.exports = {
  // preset: '@vue/cli-plugin-unit-jest/presets/no-babel',
  testRegex: '.*.spec.js$',
  moduleFileExtensions: [
    'js',
    'json',
    'vue'
  ],
  'transform': {
    '^.+\\.(js|jsx)?$': '<rootDir>/node_modules/babel-jest',
    '.*\\.(vue)$': '<rootDir>/node_modules/vue-jest', 
  },
  // "moduleNameMapper": {
  //   "\\.(jpg|jpeg|png|gif|eot|otf|webp|svg|ttf|woff|woff2|mp4|webm|wav|mp3|m4a|aac|oga)$": "<rootDir>/__mocks__/fileMock.js",
  //   "\\.(css|less)$": "<rootDir>/__mocks__/styleMock.js"
  // }
}
