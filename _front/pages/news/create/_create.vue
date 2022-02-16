<template>

    <b-container>

        <Breadcrumb :bitems="breadcrumb" />

        <TitleSeparator>Nouvel Article</TitleSeparator>

        <ArticleEditor :formErrors="formErrors" :form="form" :type="type" @submit="submit"></ArticleEditor>

    </b-container>

</template>

<script>

    import TitleSeparator from '@/components/common/TitleSeparator'
    import Breadcrumb from '@/components/common/Breadcrumb'
    import ArticleEditor from '@/components/common/Article/ArticleEditor'

    export default {
        middleware: 'auth',
        components: {
            TitleSeparator,
            Breadcrumb,
            ArticleEditor
        },

        data() {
            return {
                form: {
                    title: '',
                    slug: '',
                    description: '',
                    content: '',
                    img_id: '',
                    img_large_id: '',
                    category_id: 1,
                    published: null,
                    created_at: '',
                },

                breadcrumb: [],

                /* Specify form type: [ create | edit ] */
                type: 'create',

                dataFromChild: '',

                /* That contain errors from API callback */
                formErrors: '',
            }
        },

        methods: {

            /* Method called when submit button is pressed on child component */
            async submit() {

                this.form.user_id = this.user.id

                /* Define category for news */
                this.form.category_id = 1

                /* Just for dev phase */
                /* Quickly need to add a file system for that */
                this.form.img_id = 1
                this.form.img_large_id = 1

                /* Wait for post API callback */
                let callback = await this.$axios.post('/articles/create', this.form)
                    .then((response) => {
                        return response.data
                    })

                /* Define some properties */
                this.formErrors = await callback.formErrors
                this.success = await callback.success

                /* Redirect to new article */
                if (this.success === true) {
                    this.$router.push('/news/' + callback.article.slug)
                }

            },

        },

        created() {

            /* Just fill any text into TIPTAP editor at load */
            this.form.content = 'Votre texte'

            /* Check permissions */
            if (!this.hasPerm('news-create')) {
                console.log('401: Unauthorized')
                this.$router.push({path: '/'})
            }

            /* Define breadcrumb */
            this.breadcrumb.push(
                {text: 'Actualités', href: '/news'},
                {text: 'Nouvelle actualité'}
            );

        }
    }

</script>