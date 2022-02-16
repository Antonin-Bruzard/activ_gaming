<template>
    <div>
        <ul class="social-partners" v-if="networks">

            <li v-for="network in networks" v-if="network.show == 1">

                <a :href="network.link" class="social-partners-list" :class="network.name" target="_blank">
                    <fa :icon="['fab', network.icon]"/>
                </a>

            </li>

        </ul>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                networks: '',
            }
        },

        methods: {
            async getNetworks () {
                await this.$axios.get('/networks')
                    .then((resp)=> {
                        this.networks = resp.data
                    })
            },
        },

        mounted() {
            this.getNetworks()
        },
    }

</script>
