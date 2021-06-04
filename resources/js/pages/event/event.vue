<template>
  <div>
    <b-container>
      <div class="header">
        <div>
          <img class="img-header" src="../../../images/bar.jpg" alt="bar">
        </div>
        <div class="bar-button">
          <div class="display-flex" >
            <eva-icon class="icon-heart" name="heart-outline" fill="#D70039" width="40px" height="40px"></eva-icon>
            <div class="text-bar" >
            <span>{{ event.nb_like }} PERS</span>
            </div>
          </div>
          <div class="display-flex">
            <eva-icon class="icon-heart" name="bell-outline" fill="#D70039" width="40px" height="40px"></eva-icon>
            <div class="text-bar" >
              <div class="text">Je participe</div>
              <span>{{ event.nb_join }} PERS</span>
            </div>

          </div>
          <div class="display-flex" >
            <eva-icon class="icon-heart" name="person-outline" fill="#D70039" width="40px" height="40px"></eva-icon>
            <div class="text-bar" >
              <div class="text" >Je réserve</div>
              <span>{{ event.nb_book }} PERS</span>
            </div>
          </div>
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
.display-flex{

  display: flex;
}
.text-bar{
  display: flex;
  flex-direction: column;
  line-height: 0px;
  align-items: center;
  justify-content: center;
}
.img-header {
  object-fit: cover;
  height: 400px;
  width: 100%;
}

.bar-button {
  background-color: rgba(250, 250, 250, 0.8);
  height: 50px;
  transform: translateY(-50px);
  display: flex;
  justify-content: space-evenly;
}

.text {
  color: #D70039 !important;
  font-size: medium;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 10px;
  padding-top: 10px;
}

span {
  display: inline;
  color: #111D5E !important;
  font-size: small;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;

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
    console.log(this.$route.params.id)

    this.fetchEvent()
  },
  methods: {
    fetchEvent() {
      this.$api.get('event/' + this.$route.params.id).then(response => {
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
