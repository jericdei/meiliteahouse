module.exports = {
  root: true,
  parserOptions: {
    ecmaVersion: 2020, // Use the latest ecmascript standards
    sourceType: 'module', // Allows using import/export statements
  },
  settings: {
    react: {
      version: 'detect',
    },
  },
  env: {
    browser: true,
    amd: true,
    node: true,
  },
  extends: [
    'eslint:recommended',
    'plugin:prettier/recommended',
    'plugin:vue/essential',
  ],
  plugins: ['prettier'],
  rules: {
    'prettier/prettier': [
      'error',
      {},
      {
        usePrettierrc: true,
      },
    ],
    'vue/multi-word-component-names': 0,
    'no-console': 2,
  },
};
