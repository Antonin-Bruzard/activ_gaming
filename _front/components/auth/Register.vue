<template>
    <b-modal id="modalRegister" centered title="Inscription">
        <b-container fluid @keydown.enter.prevent="register">

            <b-form-group>
                <label for="nameRegisterInput">Nom d'utilisateur</label>
                <input v-model="form.name" type="text" :class="{ 'is-invalid': regErrors.name }" class="form-control"
                       id="nameRegisterInput" placeholder="Nom d'utilisateur">
                <div class="invalid-feedback" v-if="regErrors.name">
                    {{ regErrors.name[0] }}
                </div>
            </b-form-group>
            <b-form-group>
                <label for="emailRegisterInput">Email</label>
                <input v-model="form.email" type="email" :class="{ 'is-invalid': regErrors.email }" class="form-control"
                       id="emailRegisterInput" aria-describedby="emailHelp" placeholder="vous@email.com">
                <small id="emailHelp" class="form-text text-muted">Votre email restera confidentiel.</small>
                <div class="invalid-feedback" v-if="regErrors.email">
                    {{ regErrors.email[0] }}
                </div>
            </b-form-group>
            <b-form-group>
                <label for="passwordRegisterInput">Mot de passe</label>
                <input v-model="form.password" :class="{ 'is-invalid': regErrors.password }" type="password"
                       class="form-control" id="passwordRegisterInput" placeholder="Mot de passe">
                <div class="invalid-feedback" v-if="regErrors.password">
                    {{ regErrors.password[0] }}
                </div>
            </b-form-group>
            <b-form-group>
                <p>Déjà inscrit ? <a href="#" v-b-modal.modalConnection @click.prevent="$bvModal.hide('modalRegister')">Connexion</a>
                </p>
            </b-form-group>
        </b-container>
        <div slot="modal-footer" class="w-100">
            <b-button type="submit" variant="primary" class="w-100" @click.prevent="register">
                Inscription
            </b-button>
        </div>
    </b-modal>
</template>

<script>
    import guest from "../../middleware/guest";

    export default {
        data() {
            return {
                regErrors: [],
                form: {
                    name: '',
                    email: '',
                    password: ''
                }
            }
        },

        middleware: 'guest',

        methods: {
            async register() {
               await this.$axios.post('/auth/register', this.form)
                   .then((rep) => {
                       if (rep.data.errors) {
                           this.regErrors = rep.data.errors
                       }

                       this.$auth.login({data: this.form})
                           .then((rep) => {
                               this.$bvModal.hide('modalRegister')
                               this.$router.push('/')
                           }).catch((rep) => {
                            console.log('error : ' + rep)
                           })
                   }).catch((rep) => {
                       console.log('Connect')
                   })
            }
        }
    }
</script>