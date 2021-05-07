<template>
  <div class="container">
    <h1>test</h1>
    <StackGrid
      :columnWidth="200"
      :gutterX="20"
      :gutterY="20">
      <!-- you component like this -->
      <div class="stack-item" v-for="(item, id) in events" :key="id">
        <img class="img-card" :src="item.image_path" alt="bar">
        <div class="color" :class="{blue: id%2 === 0}">
          <h6 >{{ item.title }}</h6>
          <p>{{ item.start_at | moment('ll') }} / {{ item.place }}</p>
          <p v-if="item.price">{{ item.price }}€</p>
          <p v-if="item.price === 0  || !item.price">Gratuit</p>
<!--          <p>{{item.event_type.name}}</p>-->
        </div>
      </div>
    </StackGrid>
  </div>
</template>
<script>
import StackGrid from 'vue-stack-grid-component'

export default {
  name: 'my_feed',
  components: {
    StackGrid
  },
  data: () => ({
    events: ''
  }),
  created() {
    console.log("created")
    this.fetchEvent()
  },
  methods: {
    fetchEvent() {
      this.$api.get('/events')
        .then((response) => {
          console.log(response.data)
          this.events = response.data
          console.log(this.events)
        })
        .catch((error) => {
          this.loading = false
          console.log(error)
          console.log(error.response)
        })
    }
  }
}
</script>
<style>
.stack-item{

}
.color{
  color: #D70039;
  text-align: center;
}
.blue{
  color: #2b40a7;
}
h6{
 font-weight: bold;
}
.img-card{
  max-width: 200px;
  max-height: 225px;
  border-radius: 35px;
}
</style>
