<template>
  <Carousel class="container slider-container mt-5" v-if="this.slides">
    <CarouselSlide

      v-for="slide in this.slides"
      :key="slide.id"
      class="slider-" 
      :style="'background-image: url(' + slide.image_path + ');'"
      :index="slide.id - 1"
    >
      <div class="content p-3">
        <h2>{{ slide.title }}</h2>
        <div></div>
        <p>{{ slide.description }} </p>
      </div>
    </CarouselSlide>
  </Carousel>
</template>

<script>
import Carousel from '@/components/common/Carousel/Carousel.vue';
import CarouselSlide from '@/components/common/Carousel/CarouselSlide.vue';

export default {
  components: {
    Carousel,
    CarouselSlide
  },
  data() {
    return {
      slides: false
    }
  },

  methods: {
    async getSlides () {

      await this.$axios.get('/sliders')
              .then((data)=> {
                this.slides = data.data
              })

    }
  },

  created () {
    this.getSlides()
  }
}
</script>