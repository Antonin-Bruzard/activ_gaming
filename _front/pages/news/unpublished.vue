<template>
    <div>
        <b-container v-if="this.blogArticles && hasPerm('news-publish')">

            <Breadcrumb  :bitems="breadcrumb" />

            <TitleSeparator>Brouillons</TitleSeparator>

            <!-- PAGINATION : START -->
            <ul class="pagination justify-content-center" v-if="pagination.last_page > 1">
                <li class="page-item" :class="{disabled: (pagination.current_page == 1)}"><a class="page-link" href="" @click.prevent="goto(1)"><<</a></li>
                <li class="page-item" v-for="page in pagination.pages"><a class="page-link" href="" @click.prevent="goto(page)">{{ page }}</a></li>
                <li class="page-item" :class="{disabled: (pagination.current_page == pagination.last_page)}"><a class="page-link" href="" @click.prevent="goto(pagination.last_page)">>></a></li>
            </ul>
            <!-- PAGINATION : END -->

            <!-- BUTTONS (Head) : START -->
            <div class="d-flex mb-3" v-if="authenticated && hasPerm('news-create') || hasPerm('news-publish')">
                <b-button class="mr-3" squared variant="outline-secondary" :href="routename">&lsaquo; Retour aux actualités</b-button>
                <b-button class="mr-3" squared variant="outline-secondary" :href="routename">Créer une actualité</b-button>
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

                            <!-- article : user.avatar -->
                            <img :src="article.author.avatar.path"/>

                            <div>
                                <!-- article : author.name -->
                                <p>par <span class="author-name">{{ article.author.name }}</span></p>

                                <!-- article : article.create_at -->
                                <p class="author-date">{{ article.created_at }}</p>

                                <!-- article : schedule datetime -->
                                <p v-if="publishedIn(article.published)" class="author-date mt-1 font-italic">Publication dans {{ publishedIn(article.published) }}</p>
                            </div>
                        </div>

                        <!-- BUTTONS (Article) : START -->
                        <b-button class="blog-button" :href="routename + article.slug">Visualiser</b-button>

                        <div class="my-3 d-flex justify-content-between" v-if="authenticated || hasPerm('news-edit') || hasPerm('news-delete')">
                            <b-button size="sm" squared class="w-50 mr-1" variant="outline-primary" :href="routename + 'edit/' + article.slug" v-if="hasPerm('news-edit')">Éditer</b-button>
                            <b-button size="sm" squared class="w-50 ml-1" variant="outline-danger" @click="deleteArticle(article)" v-if="hasPerm('news-delete')">Supprimer</b-button>
                        </div>
                        <!-- BUTTONS (Article) : END -->

                    </aside>
                </div>
            </div>
        </b-container>
        <ConfirmDeletePop :article="deleteArticleSelected" @close="resetDeleteArticleSelected"></ConfirmDeletePop>
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
                deleteArticleSelected: {},

                breadcrumb: [],

                currentTimestamp: this.$moment().format('X')
            }
        },

        methods: {
            async goto(page) {
                await this.$axios.get('/articles/unpublished?paginate=5&page=' + page)
                    .then((data)=> {
                        this.blogArticles = data.data.data
                        this.category_id = this.blogArticles[0].category_id

                        for (let a = 0; a < this.blogArticles.length; a++) {
                            this.blogArticles[a].created_at = this.$moment(this.blogArticles[a].created_at).format('D MMMM YYYY à  HH[h]mm')
                        }

                        this.pagination = data.data
                        this.pagination.pages = []

                        for (let i = 0; i < this.pagination.last_page; i++) {
                            this.pagination.pages.push(i + 1)
                        }
                    })
            },

            deleteArticle (article) {
                this.deleteArticleSelected = article
                this.$bvModal.show('ConfirmDeletePop')
            },

            resetDeleteArticleSelected () {
                this.deleteArticleSelected = {}
            },

            publishedIn(scheduleDatetime) {
                if (this.currentTimestamp < scheduleDatetime) {
                    return this.$moment(scheduleDatetime).fromNow(true)
                } else {
                    return false
                }
            }
        },

        created() {

            /* Check permissions */
            if (this.hasPerm('news-publish')) {
                this.goto(1)
            }
            else {
                this.$router.push({path: '/'})
            }

            /* Define breadcrumb */
            this.breadcrumb.push(
                {text: 'Actualités', href: '/news'},
                {text: 'Brouillons'}
            );
        }

    }

</script>

