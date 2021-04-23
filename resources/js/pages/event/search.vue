<template>
  <div class="container-fluid">
      <div class="header">
        <b-row>
          <b-col class="relative">
            <img src="../../../images/today.gif" alt="gif">
            <h1>Aujourd'hui</h1>
          </b-col>
          <b-col class="relative">
            <img src="../../../images/festival.gif" alt="gif">
            <h1>Festival</h1>
          </b-col>
        </b-row>
      </div>
      <div v-for="item in events" :key="item.id">
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
.relative{

}
h1{
  position: absolute;
  color: #fff;
}
img {
  width: 100%;
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
export default {

  data: () => ({
    events: ''
  }),
  created () {
    this.fetchEvent()
  },
  methods: {
    fetchEvent () {
      this.$api.get('/event/style')
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
