const nodeExternals = require('webpack-node-externals')

module.exports = {
    mode: 'universal',
    /*
    ** Headers of the page
    */
    head: {
        title: 'Activ Gaming',
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1 , shrink-to-fit=no'},
        ],
        link: [
            {rel: 'icon', type: 'image/x-icon', href: '/logo.png'},
            {rel: 'stylesheet', href: 'https://fonts.googleapis.com/css?family=Maven+Pro|Montserrat|Poppins|Comfortaa'}
        ]
    },

    css: [
        '@fortawesome/fontawesome-svg-core/styles.css',
        '@/assets/scss/main.scss'
    ],

    /*
    ** Plugins to load before mounting the App
    */
    plugins: [
        '~/plugins/fontawesome.js',
        '~/plugins/users/policy.js',
        '~/plugins/mixins/user',
    ],


    modules: [
        'bootstrap-vue/nuxt',
        '@nuxtjs/axios',
        '@nuxtjs/auth',
        [
            'nuxt-fontawesome',
            {
                component: 'fa',
                imports: [
                    {
                        set: '@fortawesome/free-solid-svg-icons',
                        icons: ['fas']
                    },
                    {
                        set: '@fortawesome/free-brands-svg-icons',
                        icons: ['fab']
                    },
                    {
                        set: '@fortawesome/free-regular-svg-icons',
                        icons: ['far']
                    }
                ]
            }
        ]
    ],

    auth: {
        strategies: {
            local: {
                endpoints: {
                    login: {
                        url: 'auth/login', method: 'post', propertyName: 'token'
                    },
                    user: {
                        url: 'me', method: 'get', propertyName: 'data'
                    },
                    logout: {
                        url: 'auth/logout', method: 'get'
                    }
                }
            }
        },
        redirect: false
    },

    axios: {
        // proxyHeaders: false
        baseURL: 'http://activ_gaming.test:80/api'
    },
    /*
    ** Customize the progress bar color
    */
    loading: {color: '#3B8070'},

    buildModules: [
        '@nuxtjs/moment'
    ],

    moment: {
        defaultLocale: 'fr',
        locales: ['fr']
    },
    /*
    ** Build configuration
    */
    build: {
        extractCSS: true,
        /*
        ** Run ESLint on save
        */
        extend(config, {isDev, isClient}) {
            if (isDev && isClient) {
                config.module.rules.push({
                    enforce: 'pre',
                    test: /\.(js|vue)$/,
                    loader: 'eslint-loader',
                    exclude: /(node_modules)/
                })
            }
        },
        extend(config, ctx) {
            if (ctx.isServer) {
                config.externals = [
                    nodeExternals({
                        whitelist: [/^vue-slick/]
                    })
                ]
            }
        }
    }
}

