import Vue from 'vue'

import { mapGetters } from 'vuex'

const validation = {
    install(Vue, options) {
        Vue.mixin({
            computed: {
                ...mapGetters({
                    user: 'auth/user',
                    authenticated: 'auth/authenticated'
                })
            }
        })
    }
}

Vue.use(validation)