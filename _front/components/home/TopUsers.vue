<template>
    <b-container>
        <div class="row mt-5">
            <div class="top-users col-12 px-1">
                <a v-for="(user,index) in topUsers" class="top-user" href="#">
                    <img :src="'/top-user-' + (index+1) + '.png'" class="top-user-crown">
                    <img class="top-user-avatar" :src="user.avatar"/>
                    <p class="top-user-name">{{ user.name }}</p>
                    <p class="top-user-rank">{{ user.rank }}</p>
                    <p class="top-user-points">{{ user.points }} points</p>
                </a>
            </div>
        </div>
    </b-container>
</template>

<script>
    export default {
        data () {
            return {
                topUsers: [
                    {
                        id: 12,
                        name: 'Jean Pierre',
                        rank: 'Legendary',
                        points: '521',
                        avatar: '/user-avatar-1.png',
                    },
                    {
                        id: 3,
                        name: 'Chritophe54',
                        rank: 'Platinium',
                        points: '247',
                        avatar: '/user-avatar-2.png',
                    },
                    {
                        id: 24,
                        name: 'Henri Marty',
                        rank: 'Gold Elite',
                        points: '192',
                        avatar: '/user-avatar-3.png',
                    },
                    {
                        id: 9,
                        name: 'Marceldu82',
                        rank: 'Silver Noob',
                        points: '185',
                        avatar: '/user-avatar-4.png',
                    },
                    {
                        id: 32,
                        name: 'Christopher125',
                        rank: 'Copper Div',
                        points: '152',
                        avatar: '/user-avatar-5.png',
                    },
                ]
            }
        }
    }
</script>