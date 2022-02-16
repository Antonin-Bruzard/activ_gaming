<template>
  <div>
    <b-row>
      <b-col cols="6" class="news-slider px-0">
        <slot></slot>
      </b-col>
      <b-col cols="6" class="article-aside">
        <TheLastNewsAside
          v-for="lastNew in lastNews"
            :key="lastNew.id"
            :index="lastNew.id"
            :title="lastNew.title"
            :description="lastNew.description"
            :img="lastNew.thumbnail.path"
            :published="lastNew.published"
            :active="index"
            v-on:newIndex="setNewIndex"
            >     
        </TheLastNewsAside>
      </b-col>
    </b-row>
    
  </div>
</template>

<script>
import TheLastNewsAside from '@/components/home/TheLastNews/TheLastNewsAside'

export default {
  components:{
    TheLastNewsAside
  },

  data() {
    return {
      index: 0,
    }
  },

  methods: {
    setNewIndex (value) {
      this.index = value-1
    }
  },

  props: {
    lastNews: {type: Array, default: [] }
  },

  watch: {
    lastNews: function (lastNews) {
      this.setNewIndex(lastNews[0].id)
    }
  },

  created () {
    this.lastNews.forEach((article) => {
      this.index = (this.index < article.id) ? article.id - 1 : this.index
    })
  }
}
</script>
