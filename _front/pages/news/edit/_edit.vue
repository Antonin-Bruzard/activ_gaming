<template>

    <b-container>

        <Breadcrumb :bitems="breadcrumb"/>

        <TitleSeparator>Éditer l'article</TitleSeparator>

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
                    slug:'',
                    description: '',
                    content: '',
                    img_id: '',
                    img_large_id: '',
                    category_id: 1,
                    published: null,
                    created_at: '',
                    updated_at: '',
                },

                breadcrumb: [],

                /* Specify form type: [ create | edit ] */
                type: 'edit',

                /* That contain errors from API callback */
                formErrors: '',
            }
        },

        methods: {

            /* Method called when submit button is pressed on child component */
            async submit () {
                /* Wait for put API callback */
                let callback = await this.$axios.put('/articles/' + this.form.id, this.form)
                    .then((resp) => {
                        return resp.data
                    })

                /* Define errors here */
                this.formErrors = await callback.formErrors

                /* Redirect to article */
                if (callback.success === true)
                {
                    this.$router.push('/news/' + callback.article.slug)
                }

            },

            async getArticle () {

                let remoteData = await this.$axios.get('/articles/' + this.$route.params.edit)
                    .then((data)=> {
                        return data.data
                    })

                this.form = await remoteData

                /* Define breadcrumb */
                this.breadcrumb.push(
                    {text: 'Actualités', href: '/news'},
                    {text: 'Editer : ' + this.form.title, href: '/news/' + this.form.slug}
                );
            },

        },


        created() {
            /* Check permissions */
            if (this.hasPerm('news-edit')) {
                this.getArticle()
            } else {
                console.log('401: Unauthorized')
                this.$router.push({path: '/'})
            }
        },
    }

</script>