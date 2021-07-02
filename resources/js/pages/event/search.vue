<template>
  <div class="container-fluid body-height">
    <div class="header">
      <b-row>
        <b-col class="img-header">
          <img src="../../../images/today.gif" alt="gif">
          <h3 class="titre-images">Aujourd'hui</h3>
        </b-col>
        <b-col class="img-header">
          <img src="../../../images/festival.gif" alt="gif">
          <h3 class="titre-images">Les + populaires</h3>
        </b-col>
      </b-row>
    </div>
    <div class="search-bar">
      <div class="content-search-bar">
        <svg class="filter-svg-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <g data-name="Layer 2">
            <g data-name="search">
              <rect opacity="0"/>
              <path
                d="M20.71 19.29l-3.4-3.39A7.92 7.92 0 0 0 19 11a8 8 0 1 0-8 8 7.92 7.92 0 0 0 4.9-1.69l3.39 3.4a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM5 11a6 6 0 1 1 6 6 6 6 0 0 1-6-6z"/>
            </g>
          </g>
        </svg>
        Rechercher
      </div>
    </div>
    <div class="def-bar">
      <div class="content-def-bar">
        <div class="display-flex">
          <div class="pink-circle"></div>
          <div class="pl-2">Premium</div>
        </div>
        <div class="display-flex">
          <div class="blue-circle"></div>
          <div class="pl-2" >Aujourd'hui</div>
        </div>
        <div class="display-flex">
          <div class="red-circle"></div>
          <div class="pl-2">Les + populaires</div>
        </div>
      </div>
    </div>
    <div  class="items" v-for="(item, index) in events" :key="index">
      <div v-bind:class="{ 'background-item': item.promote }"></div>
      <router-link :to="{ name: 'anevent', params: { id: item.id } }" class="row g-0 card-item">
        <div class="col-md-4">
          <img :src="item.image_path" alt="bar">
        </div>

        <div class="col-md-8">
          <div class="card-body">
            <h5
              v-bind:class="{ 'card-title-blue': utc === item.start_at.split(' ')[0], 'card-title-red': utc !== item.start_at.split(' ')[0] }">
              {{ item.title }}</h5>
            <p
              v-bind:class="{ 'subtitle-blue': utc === item.start_at.split(' ')[0], 'subtitle-red': utc !== item.start_at.split(' ')[0] }">
              {{ item.place }}</p>
            <p
              v-bind:class="{ 'subtitle-blue': utc === item.start_at.split(' ')[0], 'subtitle-red': utc !== item.start_at.split(' ')[0] }">
              {{ item.start_at | moment('ll') }} au {{ item.ending_at | moment('ll') }}</p>
            <p
              v-bind:class="{ 'subtitle-blue': utc === item.start_at.split(' ')[0], 'subtitle-red': utc !== item.start_at.split(' ')[0] }">
              {{ item.town }}</p>
            <div class="price"
                 v-bind:class="{ 'subtitle-blue': utc === item.start_at.split(' ')[0], 'subtitle-red': utc !== item.start_at.split(' ')[0] }">
              {{ item.price_one }}
              <p class="price-indi" v-if="item.price_two"> • {{ item.price_two }}</p>
              <p class="price-indi" v-if="item.price_three"> • {{ item.price_three }}</p>
              <p class="price-indi" v-if="item.price_four"> • {{ item.price_four }}</p>
            </div>
            <p class="card-text text">{{ item.description | truncate(300, '...') }}</p>
            <p class=" footer-card">Publié le {{ item.created_at | moment('ll') }}</p>
            <div class="tag-item">
              <div class="event-type" v-if="item.event_type">
                {{ getDisplayName(item.event_type.name) }}
              </div>
              <div v-if="item.event_game">
                <div class="event-category" v-for="(game,i) in item.event_game" :key="i">
                  {{ game.name }}
                </div>
              </div>
              <div v-if="item.event_style">
                <div class="event-category" v-for="(style,i) in item.event_style" :key="i">
                  {{ style.name }}
                </div>
              </div>
              <div v-if="item.event_art">
                <div class="event-category" v-for="(art,i) in item.event_art" :key="i">
                  {{ art.name }}
                </div>
              </div>
              <div v-if="item.event_sport">
                <div class="event-category" v-for="(sport,i) in item.event_sport" :key="i">
                  {{ sport.name }}
                </div>
              </div>
              <div v-if="item.event_sub_style">
                <div class="event-category" v-for="(substyle,i) in item.event_sub_style" :key="i">
                  {{ substyle.sub_style_name }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </router-link>
    </div>
  </div>
</template>
<style scoped>
.display-flex{
  display: flex;
}
.tag-item {
  display: flex;
}

.content-search-bar {
  padding: 5px 10px;
}

.content-def-bar {
  padding: 5px 10px;
  justify-content: space-between;
}

.pink-circle {
  background-color: #f4cdd6;
  height: 25px;
  width: 25px;
  border-radius: 50%;
  padding: 5px 10px;
}

.blue-circle {
  background-color: #111D5E;
  height: 25px;
  width: 25px;
  border-radius: 50%;
  padding: 5px 10px;
}

.red-circle {
  background-color: #D70039;
  height: 25px;
  width: 25px;
  border-radius: 50%;
  padding: 5px 10px;
}

.content-def-bar {
  display: flex;
}

.event-category {
  display: inline-block;
  border: 2px #111D5E solid;
  border-radius: 20px;
  color: #111D5E;
  margin: 10px 5px;
  padding: 0px 10px;
}

.event-type {
  display: inline-block;
  border: 2px #D70039 solid;
  border-radius: 20px;
  color: #D70039;
  margin: 10px 10px;
  padding: 0px 10px;
}

.footer-card {
  color: #111D5E;
  font-family: Roboto, sans-serif;
  font-weight: 200;
  font-size: small;
}

.price {
  display: flex;
}

.price-indi {
  padding-left: 10px;
}

.background-item {
  background-color: #f4cdd6;
  height: -webkit-fill-available;
  width: -webkit-fill-available;
  position: absolute;
  margin-left: 150px;
}

.items {
  margin-top: 50px;
  position: relative;
  text-decoration: none;
}

.search-bar {
  max-width: 700px;
  display: flex;
  flex-direction: row;
  border: 1px #111D5E solid;
  margin: 0 auto;
  color: #111D5E;
  font-family: 'Roboto', serif;
  font-size: larger;
}

.def-bar {
  max-width: 700px;
  border: 1px #111D5E solid;
  margin: 15px auto;
  color: #111D5E;
  font-family: 'Roboto', serif;
  font-size: larger;
}

.body-height {
  height: 600vh
}

.header {
  margin-bottom: 50px;
}

.img-header {
  position: relative;
}

.card-title-blue {
  text-transform: uppercase;
  color: #111D5E !important;
  font-size: x-large;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
}

.card-title-red {
  text-transform: uppercase;
  color: #D70039 !important;
  font-size: x-large;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
}

.titre-images {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-family: Gobold_Extra2, serif;
}

h1 {
  position: absolute;
  color: #fff;
}

img {
  width: 110%;
}

.subtitle-red {
  color: #D70039;
  line-height: 15px;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
}

.subtitle-blue {
  color: #111D5E;
  line-height: 15px;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
}

.text {
  color: #111D5E;
  font-family: Roboto, sans-serif;
  font-weight: 200;
  padding: 10px 0;
  font-size: smaller;
}

.filter-svg-black {

  filter: invert(11%) sepia(86%) saturate(7252%) hue-rotate(339deg) brightness(82%) contrast(106%);
}

.card-item {
  align-items: center;
  text-decoration: none;

}
</style>

<script>
const Utils = require('../../utils')
import MagicGrid from 'vue-magic-grid'

export default {
  components: {
    'magic-grid': MagicGrid
  },
  data: () => ({
    events: '',
    utc: '',
    today: '',
  }),
  created() {
    this.fetchEvent()
  },
  methods: {
    ...Utils,
    fetchEvent() {
      this.$api.get('/events')
        .then((response) => {
          console.log(response.data)
          this.events = response.data
          this.utc = new Date().toJSON().slice(0, 10).replace(/-/g, '-');

          var d = this.events[2].start_at;
          d = d.split(' ')[0];
          console.log(d);
          if (this.utc === this.events[2].start_at.split(' ')[0]) {
            console.log("pass")
          } else {
            console.log("nope")
          }

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
