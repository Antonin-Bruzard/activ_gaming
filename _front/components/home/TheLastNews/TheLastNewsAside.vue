<template>
  <div class="article-little" :class="{active: this.active === this.index-1}" v-on:click="newIndex" >
    <div class="article-img" :style="`background-image:url('${img}');`">
    </div>
    <div class="article-content">
      <h3> {{ title }} </h3>
      <p> {{ description }} </p>
      <p class="article-date"><fa :icon="calendar" /> {{ published }} </p>
    </div>
  </div>
</template>

<script>
import { faCalendarAlt } from '@fortawesome/free-regular-svg-icons/index'
export default {
  computed: {
    calendar() {
      return faCalendarAlt
    }
  },
  props: {
    index: {type: Number, default: 1},
    title: {type: String, default: 'Title Default'},
    description: {type: String, default: 'Description Default'},
    img: {type: String, default: '/slider-1.png'},
    published: {type: String, default: '20 Août 1712'},
    active: {type: Number, default: 0}
  },
  methods: {
    newIndex(event) {
      this.$emit('newIndex', this.index)
    }
  }
}

</script>
