<template>
  <div>
    <TopHeaderNavbar />
    <MainNavbar />
    <Login></Login>
    <Register></Register>
  </div>
</template>

<script>
import TopHeaderNavbar from '@/components/common/TheHeader/TopHeaderNavbar.vue'
import MainNavbar from '@/components/common/TheHeader/MainNavbar.vue'
import Login from '@/components/auth/Login'
import Register from '@/components/auth/Register'

export default {
  components: {
    TopHeaderNavbar,
    MainNavbar,
    Login,
    Register
  }
}
</script>
