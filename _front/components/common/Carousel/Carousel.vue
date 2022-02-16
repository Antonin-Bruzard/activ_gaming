<template>
  <div class="carousel">
    <slot></slot>
    <a href="" class="carousel-nav carousel-next" @click.prevent="next">
      <fa :icon="nextButton" />
    </a>
    <a href="" class="carousel-nav carousel-prev" @click.prevent="prev">
      <fa :icon="prevButton" />
    </a>
    <div class="carousel-pagination">
      <button 
        v-for="n in slidesCount"
        :key="n"
        @click="goto(n-1)" 
        :class="{active: n - 1 === index}"
      ></button>
    </div>
  </div>
</template>

<script>
import {
faChevronCircleRight,
faChevronCircleLeft,
} from '@fortawesome/free-solid-svg-icons/index'

export default {
  data() {
    return {
      index: 0,
      slides: [],
      direction: 'right'
    }
  },
  computed: {
    slidesCount() { return this.slides.length },
    nextButton() { return faChevronCircleRight },
    prevButton() { return faChevronCircleLeft }
  },
  methods: {
    next(){
      this.index++
      this.direction = 'right'
      if (this.index >= this.slidesCount) {
        this.index = 0
      }
    },
    prev(){
      this.index--
      this.direction = 'left'
      if (this.index < 0) {
        this.index = this.slidesCount - 1
      }
    },
    goto(index) {
      this.direction = index > this.index ? 'right' : 'left'
      this.index = index
    }
  },
  mounted () {
    this.slides = this.$children
  }
}
</script>

