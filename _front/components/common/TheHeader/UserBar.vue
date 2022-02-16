<template>
    <div class="userbar mr-5">
        <ul class="user-interface">
            <!--
            <li class="px-2 p-1">
                <a href="#">
                    <fa :icon="search"/>
                </a>
            </li>
            <li class="px-2 p-1">
                <a href="#">
                    <fa :icon="bell"/>
                </a>
            </li>
            <li class="px-2 mr-auto p-1">
                <a href="#">
                    <fa :icon="envelope"/>
                </a>
            </li>
            -->

            <b-nav-item-dropdown right class="user-menu" v-if="authenticated && hasPerm('news-create') || hasPerm('news-publish')">
                <template slot="button-content" class="user-menu-button">
                    <fa :icon="featherAlt"/>
                    <span>Actualités</span>
                </template>

                <b-dropdown-item href="/news/create" v-if="hasPerm('news-create')">
                    Créer une actualité
                </b-dropdown-item>

                <b-dropdown-item href="news/unpublished" v-if="hasPerm('news-publish')">
                    Voir les brouillons
                </b-dropdown-item>
            </b-nav-item-dropdown>

            <b-nav-item-dropdown right class="user-menu">
                <template slot="button-content" class="user-menu-button">
                    <fa v-if="!authenticated" :icon="userIcon"/>
                    <img v-if="authenticated" :src="user.avatar_path"/>
                    <span v-if="authenticated">{{ user.name }}</span>
                </template>
                <!--          <b-dropdown-item href="#" class="dropdown-item">
                        Profil
                      </b-dropdown-item>
                      <b-dropdown-divider />-->
                <b-dropdown-item v-b-modal.modalConnection class="dropdown-item" v-if="!authenticated">
                    Connexion
                </b-dropdown-item>

                <b-dropdown-item v-b-modal.modalRegister class="dropdown-item" v-if="!authenticated">
                    S'enregistrer
                </b-dropdown-item>

                <b-dropdown-item class="dropdown-item" v-if="authenticated" @click.prevent="logout">
                    Déconnexion
                </b-dropdown-item>
            </b-nav-item-dropdown>

        </ul>

    </div>
</template>

<script>
    import {
        faSearch,
        faBell,
        faEnvelope,
        faUserCircle,
        faFeatherAlt,
    } from '@fortawesome/free-solid-svg-icons/index'

    export default {
        computed: {
            search() {
                return faSearch
            },
            bell() {
                return faBell
            },
            envelope() {
                return faEnvelope
            },
            userIcon() {
                return faUserCircle
            },
            featherAlt() {
                return faFeatherAlt
            }
        },

        methods: {
            logout() {
                this.$auth.logout()
            }
        },
    }
</script>

