<template>
    <b-breadcrumb :items="base" class="mt-4"></b-breadcrumb>
</template>

<script>
    export default {
        props: {
            bitems: Array,
        },

        data() {
            return{
                base: [
                    {
                        text: 'Accueil',
                        href: '/',
                    }
                ]
            }
        },

        mounted () {
            this.bitems.forEach((item) => {
                this.base.push(item)
            })
        },

        watch: {
            bitems : function () {
                this.bitems.forEach((item) => {
                    this.base.push(item)
                })
            }
        },
    }
</script>