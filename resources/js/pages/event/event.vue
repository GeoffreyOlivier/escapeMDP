<template>
  <div>
    <div class="header">
      <div>
        <img class="img-header" :src="event.image_path" alt="bar">
      </div>
      <div class="bar-button">
        <div class="display-flex" @click="interests('like', event)">
          <eva-icon v-if="!my_interest.liked" class="icon-heart" name="heart-outline" fill="#D70039" width="40px"
                    height="40px"></eva-icon>
          <eva-icon v-if="my_interest.liked " class="icon-heart" name="heart" fill="#D70039" width="40px"
                    height="40px"></eva-icon>

          <div class="text-bar">
            <span>{{ nb_interest.nb_like }} PERS</span>
          </div>
        </div>
        <div class="display-flex" @click="interests('join', event)">
          <eva-icon v-if="!my_interest.joined" class="icon-heart" name="bell-outline" fill="#D70039" width="40px"
                    height="40px"></eva-icon>
          <eva-icon v-if="my_interest.joined" class="icon-heart" name="bell" fill="#D70039" width="40px"
                    height="40px"></eva-icon>

          <div class="text-bar">
            <div class="text-in-bar">Je participe</div>
            <span>{{ nb_interest.nb_join }} PERS</span>
          </div>
        </div>
        <div class="display-flex" @click="interests('book', event)">
          <eva-icon v-if="!my_interest.booked" class="icon-heart" name="person-outline" fill="#D70039" width="40px"
                    height="40px"></eva-icon>
          <eva-icon v-if="my_interest.booked" class="icon-heart" name="person-done" fill="#D70039" width="40px"
                    height="40px"></eva-icon>
          <div class="text-bar">
            <div class="text-in-bar">Je réserve</div>
            <span>{{ nb_interest.nb_book }} PERS</span>
          </div>
        </div>
      </div>
    </div>
    <b-container>
      <div class="bloc-description">
        <h3>{{ event.title }}</h3>
        <div class="text">{{ event.start_at | moment('ll') }} • {{ event.place }}</div>
        <div class="text">{{ event.price_one }}
          <p v-if="event.price_two"> • {{ event.price_two }}</p>
          <p v-if="event.price_three"> • {{ event.price_three }}</p>
          <p v-if="event.price_four"> • {{ event.price_four }}</p>
        </div>
        <div class="text-description">{{ event.description }}</div>
        <div class="tag">
          <div class="event-type" v-if="event.event_type">
            {{ getDisplayName(event.event_type.name) }}
          </div>
          <div v-if="event.event_game">
            <div class="event-category" v-for="(game,i) in event.event_game" :key="i">
              {{ game.name }}
            </div>
          </div>
          <div v-if="event.event_style">
            <div class="event-category" v-for="(style,i) in event.event_style" :key="i">
              {{ style.name }}
            </div>
          </div>
          <div v-if="event.event_art">
            <div class="event-category" v-for="(art,i) in event.event_art" :key="i">
              {{ art.name }}
            </div>
          </div>
          <div v-if="event.event_sport">
            <div class="event-category" v-for="(sport,i) in event.event_sport" :key="i">
              {{ sport.name }}
            </div>
          </div>
          <div v-if="event.event_sub_style">
            <div class="event-category" v-for="(substyle,i) in event.event_sub_style" :key="i">
              {{ substyle.sub_style_name }}
            </div>
          </div>
        </div>


      </div>
    </b-container>
  </div>
</template>
<style scoped>
h3 {
  color: #111D5E !important;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
}

.bloc-description {
  margin: 0 50px;
}

.header {
  display: flex;
  flex-direction: column;
}

.event-type {
  display: inline-block;
  border: 2px #D70039 solid;
  border-radius: 20px;
  color: #D70039;
  margin: 10px 10px;
  padding: 0px 10px;
}

.event-category {
  display: inline-block;
  border: 2px #111D5E solid;
  border-radius: 20px;
  color: #111D5E;
  margin: 10px 5px;
  padding: 0px 10px;
}

.tag {
  display: flex;
  flex-direction: row;
}

.text {
  color: #111D5E !important;
  font-size: medium;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;
}

.text-description {
  padding: 20px 0;
  color: #111D5E !important;
  font-size: small;
  font-weight: bolder;
  font-family: roboto, serif;
}

.display-flex {
  display: flex;
}

.text-in-bar {
  padding-top: 10px;
  color: #D70039 !important;
  font-size: medium;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 10px;
}

.text-bar {
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

span {
  display: inline;
  color: #111D5E !important;
  font-size: small;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;

}

.icon-heart {
  line-height: 2px;
}


</style>
<script>
const Utils = require('../../utils')

import {EvaIcon} from 'vue-eva-icons'

export default {
  components: {
    [EvaIcon.name]: EvaIcon
  },
  data: () => ({
    event: '',
    nb_interest: '',
    my_interest:
      {
        liked: '',
        joined: '',
        booked: ''
      }


  }),
  created() {
    this.fetchEvent()
    console.log(this.$route.params.id)
  },
  methods: {
    ...Utils,
    fetchEvent() {
      this.$api.get('event/' + this.$route.params.id).then(response => {
          console.log(response)
          this.id_event = this.$route.params.id
          this.event = response.data.event
          this.nb_interest = response.data
          if (response.data.my_interest !== null) {
            this.my_interest = response.data.my_interest
          }

          console.log(response.data)

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
