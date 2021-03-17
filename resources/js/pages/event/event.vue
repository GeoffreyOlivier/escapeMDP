<template>
  <div>
    <b-container>
      <div class="header">
        <div>
          <img class="img-header" src="../../../images/bar.jpg" alt="bar">
        </div>
        <div class="bar-button">
          <p><eva-icon class="icon-heart" name="heart-outline" fill="#D70039" width="40px" height="40px"></eva-icon> <span>{{ event.nb_like }} PERS</span></p>
          <p>Je participe <span> {{ event.nb_join }} PERS</span></p>
          <p>Je réserve <span> {{ event.nb_book }} PERS</span></p>
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
    event: ''
  }),
  created() {
    console.log(this.$route.params.id)
    this.fetchEvent()
  },
  methods: {
    fetchEvent() {
      this.$api.get('event/' + this.$route.params.id).then(response => {
          console.log(response)
          this.event = response.data[0]
          console.log(this.event)

          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    },
    join() {
      console.log("join")
      this.$api.post('event/join/' + this.$route.params.id).then(response => {
          console.log(response)
          console.log(this.event)
          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    },
    unjoin() {
      console.log("unjoin")
      this.$api.put('event/join/' + this.$route.params.id).then(response => {
          console.log(response)
          console.log(this.event)
          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    },
    book() {
      console.log("book")
      this.$api.post('event/book/' + this.$route.params.id).then(response => {
          console.log(response)
          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    },
    unbook() {
      console.log("unbook")
      this.$api.put('event/book/' + this.$route.params.id).then(response => {
          console.log(response)
          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    },
    like() {
      console.log("like")
      this.$api.post('event/like/' + this.$route.params.id).then(response => {
          console.log(response)
          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    },
    unlike() {
      console.log("unlike")
      this.$api.put('event/like/' + this.$route.params.id).then(response => {
          console.log(response)
          console.log("success")
        }
      ).catch(err => {
        console.log(err)
        console.log("error")
      })
    }
  }
}
</script>
