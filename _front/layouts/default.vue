<template>
  <div class="background">
    <img src="/bg.png" class="background-img">
    <TheHeader />
    <nuxt class="nuxt" />
    <TheFooter />
  </div>
</template>

<script>
import TheHeader from '@/components/common/TheHeader/TheHeader'
import TheFooter from '@/components/common/TheFooter/TheFooter'
export default {
  components: {
    TheHeader,
    TheFooter
  }
}
</script>