<template>
    <b-modal id="ConfirmDeletePop" class="ConfirmDeletePop" centered title="Confirmation suppression">
        <b-container fluid>
            <p>Êtes vous sur de vouloir supprimer <b>{{article.title}}</b> ?</p>
        </b-container>
        <div slot="modal-footer" class="w-100">
            <b-button type="submit" variant="danger"  @click.prevent="deleteArticle">
                Supprimer
            </b-button>
            <b-button type="submit" variant="secondary" @click.prevent="close">
                Annuler
            </b-button>
        </div>
    </b-modal>
</template>

<script>

    export default {
        props: {
            article: Object
        },

        methods: {
            /*
            |--------------------------------------------------------------------------
            | Delete an article.
            |--------------------------------------------------------------------------
            |
            | Call api with axios request to destroy an article.
            |
            */
            deleteArticle() {
                this.$axios.delete('/articles/' + this.article.slug).then((response) => {
                    /* Close the modal box */
                    this.close()

                    console.log(this.$route.name)

                    /* Refresh the page */
                    this.$router.go()
                })
            },

            /*
            |--------------------------------------------------------------------------
            | Close modal.
            |--------------------------------------------------------------------------
            |
            | Close the modal and emit close.
            |
            */
            close () {
                this.$emit('close')
                this.$bvModal.hide('ConfirmDeletePop')
            }
        }
    }
</script>
