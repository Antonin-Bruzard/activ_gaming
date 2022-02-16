<template>
  <transition :name="transition">
    <div v-show="visible">
      <slot></slot>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    index: {type: Number, default: 0}
  },
  computed: {
    transition() {
      if (this.$parent.direction){
        return 'slide-' + this.$parent.direction
      }
    },
    visible () {
      return this.index === this.$parent.index
    }
  }
}
</script>


