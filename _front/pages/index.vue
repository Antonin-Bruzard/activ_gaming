<template>
  <div>
    <TheCarousel />
    <TitleSeparator>Dernières actus</TitleSeparator>
    <TheLastNews />
    <TitleSeparator>Top utilisateurs</TitleSeparator>
    <TopUsers/>
    <TitleSeparator>L'équipe</TitleSeparator>
    <Staff/>
  </div>
</template>

<script>
import TheCarousel from '@/components/home/TheCarousel/TheCarousel'
import TitleSeparator from '@/components/common/TitleSeparator'
import TheLastNews from '@/components/home/TheLastNews/TheLastNews'
import TopUsers from '@/components/home/TopUsers'
import Staff from '@/components/home/Staff'

export default {
  components: {
    TheCarousel,
    TitleSeparator,
    TheLastNews,
    TopUsers,
    Staff
  }
}
</script>

