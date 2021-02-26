<template>
  <div>
    <b-container>
      <div class="header">
        <b-row>
          <b-col>
            <img src="../../../images/Composition1.gif" alt="gif">
          </b-col>
          <b-col>
            <img src="../../../images/Composition1.gif" alt="gif">
          </b-col>
        </b-row>
      </div>
      <h1>Mon compte</h1>
      <div v-for="item in events" :key="item.id">
        <div class="card mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="../../../images/event-img.png" alt="bar">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ item.title }}</h5>
                <p class="card-text subtitle">{{ item.place }}, {{ item.price }}</p>
                <p class="card-text subtitle">{{ item.start_at }}, {{ item.town }}</p>

                <p class="card-text text">{{ item.description }}</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </b-container>
  </div>
</template>
<style>
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
  created() {
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
