<template>
  <section class="top-header-navbar">
    <SocialPartners />
    <UserBar />
  </section>
</template>

<script>
import SocialPartners from '@/components/common/SocialPartners'
import UserBar from '@/components/common/TheHeader/UserBar'

export default {
  components: {
    SocialPartners,
    UserBar
  }

}
</script>



