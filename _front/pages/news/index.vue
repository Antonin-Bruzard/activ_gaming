<template>
    <div>
        <b-container v-if="this.blogArticles">

            <Breadcrumb :bitems="breadcrumb"/>

            <TitleSeparator>Actualités</TitleSeparator>

            <!-- PAGINATION : START -->
            <ul class="pagination justify-content-center" v-if="pagination.last_page > 1">
                <li class="page-item" :class="{disabled: (pagination.current_page == 1)}"><a class="page-link" href="" @click.prevent="goto(1)"><<</a></li>
                <li class="page-item" v-for="page in pagination.pages"><a class="page-link" href="" @click.prevent="goto(page)">{{ page }}</a></li>
                <li class="page-item" :class="{disabled: (pagination.current_page == pagination.last_page)}"><a class="page-link" href="" @click.prevent="goto(pagination.last_page)">>></a></li>
            </ul>
            <!-- PAGINATION : END -->

            <!-- BUTTONS (Head) : START -->
            <div class="d-flex mb-3" v-if="authenticated && hasPerm('news-create') || hasPerm('news-publish')">
                <b-button class="mr-3" v-if="authenticated && hasPerm('news-create')" squared variant="outline-secondary" :href="routename + 'create'">Créer une actualité</b-button>
                <b-button class="mr-3" v-if="authenticated && this.hasPerm('news-publish')" squared variant="outline-secondary" :href="routename + 'unpublished'" title="Editer, mettre en ligne une actualité">Brouillons ({{ unpublishedsCount }})</b-button>
            </div>
            <!-- BUTTONS (Head) : END -->

            <div v-for="article in blogArticles" class="blog mb-4">
                <img :src="article.banner.path"/>
                <div class="article-content p-4">
                    <section>
                        <h2 class="py-2"><a :href="routename + article.slug">{{ article.title }}</a></h2>
                        <p>{{ article.description }}</p>
                    </section>
                    <aside class="p-2">
                        <div class="article-author mb-3">
                            <img :src="article.author.avatar.path"/>
                            <div>
                                <p>par <span class="author-name">{{ article.author.name }}</span></p>
                                <p class="author-date">{{ article.published }}</p>
                            </div>
                        </div>

                        <!-- BUTTONS (Article) : START -->
                        <b-button class="blog-button" :href="routename + article.slug">Lire l'article</b-button>

                        <div class="my-3 d-flex justify-content-between" v-if="authenticated || hasPerm('news-edit') || hasPerm('news-delete')">
                            <b-button size="sm" squared class="w-50 mr-1" variant="outline-primary" :href="routename + 'edit/' + article.slug" v-if="hasPerm('news-edit')">Éditer</b-button>
                            <b-button size="sm" squared class="w-50 ml-1" variant="outline-danger" @click="deleteArticle(article)" v-if="hasPerm('news-delete')">Supprimer</b-button>
                        </div>
                        <!-- BUTTONS (Article) : END -->

                    </aside>
                </div>
            </div>
        </b-container>
        <ConfirmDeletePop :article="deleteArticleSelected" @close="resetDeleteArticleSelected" ></ConfirmDeletePop>
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
                routename: '/news/',
                pagination: '',
                blogArticles: false,
                category_id: '',
                unpublisheds: false,
                unpublishedsCount: false,
                deleteArticleSelected: {},

                /* Send links to breadcrumbs */
                breadcrumb: [],
            }
        },

        methods: {
            /**
             * En ligne = 1
             * Hors ligne = 0
             * @param page
             * @returns {Promise<void>}
             */
            async goto(page) {
                let callback = await this.$axios.get('/articles?paginate=5&page=' + page)
                        .then((data)=> {

                            /* Make pagination */
                            this.pagination = data.data
                            this.pagination.pages = []

                            for (let i = 0; i < this.pagination.last_page; i++) {
                                this.pagination.pages.push(i + 1)
                            }

                            /* Return data */
                            return data.data.data
                        })

                /* Create a temp articles var before date editing */
                var articles = await callback

                /* Use Momentjs library to set date human readable. */
                for (let a = 0; a < articles.length; a++) {
                    articles[a].published = this.$moment(articles[a].published).format('D MMMM YYYY à  HH[h]mm')
                }

                /* Push it to view */
                this.blogArticles = articles
                this.category_id = callback[0].category_id

                if (this.hasPerm('news-unpublish')) {
                    this.getUnpublished()
                }

                /* Define breadcrumb */
                this.breadcrumb.push({text: 'Actualités',href: '/news'});
            },

            async getUnpublished (authenticated) {
                let unpublisheds = await this.$axios.get('/articles/unpublished')
                    .then((response) => {
                        if (response.data.length >= 1)
                        {
                            this.unpublisheds = response.data
                            this.unpublishedsCount = response.data.length
                        }
                        else
                        {
                            this.unpublishedsCount = 0
                        }
                    })
            },

            deleteArticle (article) {
                this.deleteArticleSelected = article
                this.$bvModal.show('ConfirmDeletePop')
            },

            resetDeleteArticleSelected () {
                this.deleteArticleSelected = {}
            }
        },

        created() {
            this.goto(1)
        }

    }

</script>

