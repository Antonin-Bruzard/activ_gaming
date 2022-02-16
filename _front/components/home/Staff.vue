<template>
    <b-container>
        <b-row>
            <div class="staff col-12 px-1">
                <!-- Administrateurs -->
                <div class="staff-group">
                    <a href="#" v-for="admin in staff.administrateur" class="staff-member">
                        <img class="staff-member-avatar" :src="admin.avatar" alt=""/>
                        <p class="staff-member-name">{{ admin.name }}</p>
                        <p class="staff-grade-fonda">{{ admin.group }}</p>
                    </a>
                </div>
                <!-- Manager</h2> -->
                <div class="staff-group">
                    <a href="#" v-for="manager in staff.manager" class="staff-member">
                        <img class="staff-member-avatar" :src="manager.avatar" alt=""/>
                        <p class="staff-member-name">{{ manager.name }}</p>
                        <p class="staff-grade-manager">{{ manager.group }}</p>
                    </a>
                </div>
                <!-- Modérateurs</h2> -->
                <div class="staff-group">
                    <a href="#" v-for="modo in staff.moderateur" class="staff-member">
                        <img class="staff-member-avatar" :src="modo.avatar" alt=""/>
                        <p class="staff-member-name">{{ modo.name }}</p>
                        <p class="staff-grade-modo">{{ modo.group }}</p>
                    </a>
                </div>
            </div>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        data () {
            return {
                staff: {
                    administrateur: [
                        {
                            id: 1,
                                name: 'Dekadmin',
                            avatar: '/user-avatar-2.png',
                            group: 'Admin'
                        },
                        {
                            id: 2,
                                name: 'Darcks',
                            avatar: '/user-avatar-5.png',
                            group: 'Admin'
                        },
                        {
                            id: 3,
                                name: 'Weedy',
                            avatar: '/user-avatar-1.png',
                            group: 'Admin'
                        }
                    ],
                    manager: [
                        {
                            id: 4,
                            name: 'Patachou',
                            avatar: '/user-avatar-3.png',
                            group: 'Manager'
                        }
                    ],
                    moderateur: [
                        {
                            id: 5,
                            name: 'Targaria',
                            avatar: '/user-avatar-4.png',
                            group: 'Modérateur'
                        },
                        {
                            id: 6,
                            name: 'guhurak',
                            avatar: '/user-avatar-6.png',
                            group: 'Modérateur'
                        }
                    ]
                }
            }
        }
    }
</script>