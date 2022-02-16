<template>
    <b-container v-if="this.lastNews">
        <TheLastNewsArticle class="container mt-5" :lastNews="lastNews">
            <TheLastNewsArticleSlide
                    v-for="lastNew in lastNews"
                    :key="lastNew.id"
                    :index="lastNew.id - 1"
                    class="last-news"
            >
                <article class="px-0">
                    <img :src="lastNew.banner.path">
                    <div class="p-2">
                        <h3>{{ lastNew.title }}</h3>
                        <p> {{ lastNew.description }} </p>
                        <b-button :href="route + lastNew.slug" variant="outline-danger" squared>Lire l'article</b-button>
                    </div>
                </article>
            </TheLastNewsArticleSlide>
        </TheLastNewsArticle>
    </b-container>
</template>

<script>
    import TheLastNewsArticle from '@/components/home/TheLastNews/TheLastNewsArticle'
    import TheLastNewsArticleSlide from '@/components/home/TheLastNews/TheLastNewsArticleSlide'

    export default {
        components: {
            TheLastNewsArticle,
            TheLastNewsArticleSlide
        },

        data() {
            return {
                route: '/news/',
                lastNews: false
            }
        },
        methods: {
            goto(index) {
                this.index = index
            },

            getLastNews() {
                this.$axios.get('/articles?published=yes&limit=4')
                    .then((data) => {

                        /* Use Momentjs library to set date human readable. */
                        for (let a = 0; a < data.data.length; a++) {
                            data.data[a].published = this.$moment(data.data[a].published).format('D MMMM YYYY à  HH[h]mm')
                        }

                        /* return data */
                        this.lastNews = data.data
                    })
            }
        },

        created() {
            this.getLastNews()
        }

    }
</script>