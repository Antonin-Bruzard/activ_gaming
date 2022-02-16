<template>

    <b-container>
        <div class="blog-edit p-4">

            <b-form>

                <div class="row">

                    <!-- ALERTS -->
                    <div v-if="formErrors" class="col-sm-12">
                        <b-alert variant="warning" show v-for="errors in this.formErrors" v-bind:key="formErrors">
                            {{ errors[0] }}
                        </b-alert>
                    </div>

                    <div v-if="scheduledError" class="col-sm-12">
                        <b-alert variant="warning" show>{{scheduledError}}</b-alert>
                    </div>

                    <!-- LEFT SIDE -->
                    <div class="col col-lg-6 col-sm-12">

                        <!-- TITLE -->
                        <b-form-group
                                label="Titre de l'article"
                                label-for="titre"
                        >
                            <b-form-input
                                    id="titre"
                                    required
                                    placeholder="Titre"
                                    v-model="form.title"
                            ></b-form-input>
                        </b-form-group>

                        <!-- SLUG -->
                        <b-form-group
                                label="Slug de l'article"
                                label-for="slug"
                        >
                            <b-form-input
                                    id="slug"
                                    required
                                    placeholder="Slug de l'article"
                                    v-model="form.slug"
                            ></b-form-input>
                        </b-form-group>
                    </div>
                    <!-- /LEFT SIDE -->

                    <!-- RIGHT SIDE -->
                    <div class="col col-lg-6 col-sm-12">

                        <!-- SCHEDULE DATETIME : DATETIME PICKER -->
                        <div v-if="type == 'create' || (currentTimestamp < form.published)" class="from-group">

                            <label v-if="type == 'create'" class="d-block" for="datepicker">Programmer la publication ?</label>
                            <label v-else class="d-block" for="datepicker">Modifier la date de publication ?</label>

                            <input v-if="type == 'create'" class="form-control" id="datepicker" type="datetime-local" @input="setPicker">
                            <input v-else class="form-control" id="datepicker" type="datetime-local" @input="setPicker" :value="this.$moment(form.published).format(formatInput)">

                        </div>

                        <!-- BANNER - BIG -->
                        <b-form-group
                                label="Bannière"
                                label-for="banner"
                                class="mt-3"
                        >
                            <b-form-input
                                    id="banner"
                                    required
                                    placeholder="https://"
                                    v-model="form.img_large_id"
                            ></b-form-input>
                        </b-form-group>

                        <!-- BANNER - SMALL -->
                        <b-form-group
                                label="Miniature"
                                label-for="embed"
                        >
                            <b-form-input
                                    id="embed"
                                    required
                                    placeholder="https://"
                                    v-model="form.img_id"
                            ></b-form-input>
                        </b-form-group>
                    </div>
                    <!-- /RIGHT SIDE -->

                    <!-- WIDE -->
                    <div class="col col-lg-12 col-sm-12">

                        <!-- DESCRIPTION -->
                        <b-form-group
                                label="Description"
                                label-for="description"
                        >
                            <b-form-textarea
                                    id="description"
                                    required
                                    placeholder="Description de l'article"
                                    rows="3"
                                    max-rows="6"
                                    v-model="form.description"
                            ></b-form-textarea>
                        </b-form-group>

                        <b-form-group>
                            <EditorFull v-if="form.content" :form="form" v-on:childToParent="onChildClick" class="mt-3"></EditorFull>
                        </b-form-group>

                        <!-- CHECKBOX : ONLINE -->
                        <b-form-checkbox
                                v-if="type == 'create' && !scheduled"
                                id="checkbox-1"
                                name="checkbox-1"
                                v-model="online"
                                v-on:change="setOnline"
                        >
                            Publier l'article maintenant ?
                        </b-form-checkbox>

                        <!-- CHECKBOX : DISACTIVE -->
                        <b-form-checkbox
                                v-if="type == 'edit'"
                                id="checkbox-2"
                                name="checkbox-2"
                                v-model="disactive"
                                v-on:change="setDisactive"
                        >
                            Désactiver l'article ?
                        </b-form-checkbox>

                        <!-- BUTTON : CREATE -->
                        <b-form-group class="mt-3" v-if="type == 'create' && online">
                            <b-button class="btn btn-success" type="submit" squared variant="primary" @click.prevent="emitToParent">Publier l'article</b-button>
                        </b-form-group>

                        <b-form-group class="mt-3" v-if="type == 'create' && !online && !scheduled">
                            <b-button class="btn btn-warning" type="submit" squared variant="primary" @click.prevent="emitToParent">Publier en tant que brouillon</b-button>
                        </b-form-group>

                        <b-form-group class="mt-3" v-if="type == 'create' && scheduled">
                            <b-button class="btn btn-success" type="submit" squared variant="primary" @click.prevent="emitToParent">Programmer la publication</b-button>
                        </b-form-group>

                        <!-- BUTTON : EDIT -->
                        <b-form-group class="mt-3" v-if="type == 'edit' && online && !disactive">
                            <b-button class="btn btn-success" type="submit" squared variant="primary" @click.prevent="emitToParent">Modifier l'article</b-button>
                        </b-form-group>

                        <b-form-group class="mt-3" v-if="type == 'edit' && disactive">
                            <b-button class="btn btn-danger" type="submit" squared variant="primary" @click.prevent="emitToParent">Désactiver l'article</b-button>
                        </b-form-group>

                    </div>
                    <!-- /WIDE -->

                </div>

            </b-form>

        </div>
    </b-container>

</template>

<script>
    import EditorFull from '@/components/common/Editor/EditorFull'

    export default
    {
        name: 'ArticleEditor',
        components: {EditorFull},

        data() {
            return {
                /* Define online */
                online: false,

                /* Define to disactive news */
                disactive: false,

                /* Is picked, schedule date ? */
                scheduled: false,

                /* Offset to add on current timestamp */
                scheduleOffset: 30,

                /* Define date formats */
                formatInput: 'YYYY-MM-DD\THH:mm:ss',
                formatForm: 'YYYY-MM-DD HH:mm:ss',

                /* Current timestamp */
                currentTimestamp: this.$moment().add(this.scheduleOffset, 'minutes').format('X'),

                /* Count input datetime change event call (prevent multiple call) */
                counter: false,

                /* If there is any error on datetime input (schedule date < now) */
                scheduledError: '',
            }
        },

        //TODO: This watcher is maybe no longer required.
        watch: {
            /* Put checkbox checked if published is define */
            form : function () {
                if (this.form.published) {
                    this.online = true
                } else {
                    this.online = false
                }
            },
        },

        methods: {

            /**
             * Schedule a programmed publish datetime.
             */
            setPicker (e) {
                var schedul = this.$moment(e.target.value).format(this.formatForm)
                var schedulTimestamp = this.$moment(e.target.value).format('X')

                this.counter++

                /* Wait for second occurrence of 'change' event */
                if (this.counter == 2) {

                    // published_to (offset +30 minutes) should be superior to current date.
                    if (schedulTimestamp < this.currentTimestamp) {
                        this.scheduledError = "Les publications programmées doivent être partagées entre "+ this.scheduleOffset +" minutes et 2 mois à partir du moment où vous les avez créées."
                        this.scheduled = false
                    } else {
                        /* Reset error message */
                        this.scheduledError = ''
                        /* Set scheduled to true */
                        this.scheduled = true
                        this.form.published = schedul
                    }
                }

                /* Reset counter */
                if (this.counter == 2) {
                    this.counter = 0
                }
            },

            /**
             * Put news online now.
             *
             * Put a datetime into form.published.
             */
            setOnline (e) {
                this.form.published = this.$moment().format(this.formatForm)
            },

            /**
             * Disactive a news
             *
             * This method just will set form.published to null.
             * If form.published is null, news back to unpublished.
             */
            setDisactive (e) {
                this.form.published = null
            },

            /**
             * Send form to parent vue.
             */
            emitToParent (event) {

                this.onChildClick()

                /**
                 * Send data to parent.
                 */
                if (!this.scheduledError) {
                    this.$emit('submit', this.form)
                }
            },

            onChildClick () {}

        },

        /**
         * Load props from parents.
         */
        props: {
            form: Object,
            type: String,
            formErrors: [String, Object]
        },
    }
</script>