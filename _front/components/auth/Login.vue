<template>
    <b-modal id="modalConnection" centered title="Connexion">
        <b-container fluid @keydown.enter.prevent="login">

            <div class="alert alert-warning" v-if="errors.email">
                {{ errors.email[0] }}
            </div>

            <b-form-group>
                <label for="emailLoginInput">Email </label>
                <input v-model="form.email" type="email" :class="{ 'is-invalid': errors.email }" class="form-control" id="emailLoginInput" aria-describedby="emailHelp" placeholder="email@email.com">
            </b-form-group>
            <b-form-group>
                <label for="passwordLoginInput">Mot de passe</label>
                <input v-model="form.password" :class="{ 'is-invalid': errors.email }" type="password" class="form-control" id="passwordLoginInput" placeholder="Mot de passe">
            </b-form-group>
            <b-form-group>
                <p>Pas encore inscrit ? <a href="#" v-b-modal.modalRegister @click.prevent="$bvModal.hide('modalConnection')">Créer un compte</a></p>
            </b-form-group>
        </b-container>
        <div slot="modal-footer" class="w-100">
            <b-button type="submit" variant="primary" class="w-100" @click.prevent="login">
                Connexion
            </b-button>
        </div>
    </b-modal>
</template>

<script>
    import guest from "../../middleware/guest";

    export default {
        data () {
            return {
                errors: '',
                form: {
                    name: '',
                    email: '',
                    password: ''
                }
            }
        },

        middleware: 'guest',

        methods: {
            async login() {
                await this.$auth.login({data: this.form}).then((rep) => {

                    /**
                     * Cacher le modal
                     */
                    this.$bvModal.hide('modalConnection')

                    /**
                     * Reset des identifiants.
                     */
                    this.form.name = ''
                    this.form.email = ''
                    this.form.password = ''
                })
            }
        },
    }
</script>&