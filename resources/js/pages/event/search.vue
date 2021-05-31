<template>
  <div class="container-fluid body-height">
      <div class="header">
        <b-row>
          <b-col class="img-header">
            <img src="../../../images/today.gif" alt="gif">
            <h3 class="titre-images" >Aujourd'hui</h3>
          </b-col>
          <b-col class="img-header">
            <img src="../../../images/festival.gif" alt="gif">
            <h3 class="titre-images">Les + populaires</h3>
          </b-col>
        </b-row>
      </div>
      <div v-for="item in events">
        <div class="card mb-3" >
          <div class="row g-0">
            <div class="col-md-4">
              <img :src="item.image_path" alt="bar">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ item.title }}</h5>
                <p class="card-text subtitle">{{ item.place }}, {{ item.price }}</p>
                <p class="card-text subtitle">{{ item.start_at }}, {{ item.town }}</p>

                <p class="card-text text">{{ item.description | truncate(300, '...') }}</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>
<style>
.body-height{
  height: 600vh
}
.header{
  margin-bottom: 50px;
}
.img-header{
  position: relative;
}
.card-title{
  text-transform: uppercase;
}
.titre-images{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-family: Gobold_Extra2, serif;
}
h1{
  position: absolute;
  color: #fff;
}
img {
  width: 110%;
}

h5 {
  color: #111D5E !important;
  font-size: x-large;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
}

.subtitle {
  color: #D70039;
}

.text {
  color: #111D5E
}

</style>

<script>

import MagicGrid from 'vue-magic-grid'
export default {
components: {
  'magic-grid' : MagicGrid
},
  data: () => ({
    events: ''
  }),
  created () {
    this.fetchEvent()
  },
  methods: {
    fetchEvent () {
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
