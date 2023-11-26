const path = require('path');

module.exports = {
    root: true,
    parserOptions: {
        parser: '@babel/eslint-parser',
        ecmaVersion: 11,
        sourceType: 'module',
        requireConfigFile: false,
    },
    env: {
        browser: true,
        es2020: true,
        es6: true,
        'vue/setup-compiler-macros': true,
    },
    extends: ['airbnb-base', 'plugin:vue/vue3-recommended', 'plugin:jsdoc/recommended'],
    // required to lint *.vue files
    plugins: ['vue'],
    rules: {
        'import/extensions': [
            'error',
            'always',
            {
                js: 'never',
                mjs: 'never',
                jsx: 'never',
                ts: 'never',
                tsx: 'never',
                cjs: 'never',
            },
        ],
        'no-param-reassign': [
            'error',
            {
                props: true,
                ignorePropertyModificationsFor: [
                    'state', // for vuex state
                    'event', // event handlers
                    'acc', // for reduce accumulators
                    'e', // for e.returnvalue
                ],
            },
        ],
        'jsdoc/require-returns': 0,
        'max-len': 0,
        'no-console': ['error', { allow: ['warn', 'error', 'info'] }],
        'jsdoc/require-param-description': 0,
        'jsdoc/check-types': 0,
        '@intlify/vue-i18n/no-raw-text': 0,
        'import/prefer-default-export': 0,
        'jsdoc/require-param': 0,
        'linebreak-style': 0,
        'vue/v-slot-style': 0,
    },
    settings: {
        'import/resolver': {
            alias: {
                map: [
                    [
                        '~',
                        path.resolve(__dirname, 'node_modules'),
                    ],
                    [
                        '@js',
                        path.resolve(__dirname, 'assets/js'),
                    ],
                    [
                        '@scss',
                        path.resolve(__dirname, 'assets/scss'),
                    ],
                ],
                extensions: ['.js', '.json', '.vue', '.scss'],
            },
        },
        react: {
            version: '999.999.999', // Fix warning for react
        },
    },
};
