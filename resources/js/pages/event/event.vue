<template>
  <div>
    <b-container>
      <div class="header">
        <div>
          <img class="img-header" src="../../../images/bar.jpg" alt="bar">
        </div>
        <div class="bar-button">
          <p @click="interests('like', event)" ><eva-icon class="icon-heart" name="heart-outline" fill="#D70039" width="40px" height="40px"></eva-icon> <span>{{ event.nb_like }} PERS</span></p>
          <p @click="interests('join', event)" >Je participe <span> {{ event.nb_join }} PERS</span></p>
          <p @click="interests('book', event)" >Je réserve <span> {{ event.nb_book }} PERS</span></p>
        </div>
        <eva-icon name="github" animation="pulse" fill="limegreen"></eva-icon>
      </div>
    </b-container>
  </div>
</template>
<style scoped>
.header {
  display: flex;
  flex-direction: column;

}

.img-header {
  object-fit: cover;
  height: 400px;
  width: 100%;
}

.bar-button {
  background-color: rgba(250, 250, 250, 0.5);
  height: 50px;
  transform: translateY(-50px);
  display: flex;
  justify-content: space-evenly;
}

p {
  color: #D70039 !important;
  font-size: x-large;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 50px;
}

span {
  color: #111D5E !important;
  font-size: small;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 60px;

}
.icon-heart{
  line-height: 2px;
}


</style>
<script>
import { EvaIcon } from 'vue-eva-icons'
export default {
  components: {
    [EvaIcon.name]: EvaIcon
  },
  data: () => ({
    event: '',
  }),
  created() {
    console.log(this.$route.params.eventID)

    this.fetchEvent()
  },
  methods: {
    fetchEvent() {
      this.$api.get('event/' + this.$route.params.eventID).then(response => {
          console.log(response)
          this.event = response.data
          console.log(this.event)

          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    },
    interests(v, i) {
      this.$api.post('/event/' + i.id + "/interest/" + v)
        .then((response) => {
          console.log(response.data)
          this.fetchEvent()
        })
        .catch((error) => {
          console.log(error)
          console.log(error.response)
        })
    }
  }
}
</script>
