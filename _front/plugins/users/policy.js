import Vue from 'vue'

Vue.mixin({
    methods: {

        /* CHECK A ROLE */

        getRoleName(role)
        {
            if (!role)
            {
                return
            }

            var names = []

            for (let i = 0; i < role.length; i++) {
                names.push(role[i].name)
            }

            return names
        },

        hasRole(name) {

            if (this.user.roles === undefined)
            {
                return
            }

            var roles = this.getRoleName(this.user.roles)

            return roles.includes(name)
        },

        /* CHECK PERMISSIONS */

        getPermissions()
        {
            if (this.user.roles === undefined)
            {
                return
            }

            for (var i = 0; i < this.user.roles.length; i++)
            {
                return this.user.roles[i].permissions
            }
        },

        hasPerm(permission)
        {
            if (this.user.roles === undefined)
            {
                return
            }

            var permArray = this.getPermissions()

            for (var i = 0; i < permArray.length; i++)
            {
                if (permission == permArray[i].name)
                {
                    return true
                }
            }
        }
    },

    mounted() {
        //
    },
})