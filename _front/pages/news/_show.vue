<template>
    <div>
        <b-container v-if="this.article">

            <Breadcrumb :bitems="breadcrumb"/>

            <TitleSeparator>{{ article.title }}</TitleSeparator>

            <div class="blog-article mb-4">
                <img :src="article.img_large_path"/>
                <div class="article-content p-4">
                    <section>

                        <!-- BUTTONS : START -->
                        <div class="pull-right mb-3" v-if="authenticated || hasPerm('news-edit') || hasPerm('news-delete')">
                            <b-button size="sm" squared variant="outline-primary" :href="routename + article.slug" v-if="this.hasPerm('news-edit')">Éditer</b-button>
                            <b-button size="sm" squared variant="outline-danger" v-b-modal.ConfirmDeletePop  v-if="this.hasPerm('news-delete')">Supprimer</b-button>
                        </div>
                        <!-- BUTTONS : END -->

                        <div class="article-author mb-3">

                            <img :src="article.author_avatar_path"/>

                            <div class="author-infos">

                                <p><span class="author-name">{{ article.author }}</span></p>

                                <p v-if="(this.$moment(article.published) > this.$moment())" class="author-date">Publication dans {{ $moment(article.published).fromNow(true) }}</p>
                                <p v-else class="author-date">publié le {{ this.$moment(article.published).format('D MMMM YYYY [à]  HH[h]mm') }}</p>

                            </div>
                        </div>
                        <p v-html="article.content"></p>
                    </section>
                </div>
            </div>
        </b-container>
        <ConfirmDeletePop :article="article"></ConfirmDeletePop>
    </div>
</template>

<script>
    import TitleSeparator from '@/components/common/TitleSeparator'
    import Breadcrumb from '@/components/common/Breadcrumb'
    import ConfirmDeletePop from '@/components/common/Article/ConfirmDeletePop'

    export default {
        components: {
            TitleSeparator,
            Breadcrumb,
            ConfirmDeletePop
        },

        data () {
            return {
                routename: '/news/edit/',
                article: {},
                breadcrumb: [],

                currentTimestamp: this.$moment()
            }
        },

        methods: {
            async getArticle () {
                await this.$axios.get('/articles/' + this.$route.params.show)
                    .then((data)=> {
                        /* Define article data */
                        this.article = data.data

                        /* Define breadcrumb */
                        this.breadcrumb.push(
                            {text: 'Actualités', href: '/news'},
                            {text: this.article.title, href: '/news/' + this.article.slug}
                        );
                    })
            },
        },

        created() {
            this.getArticle()
        }
    }

</script>

