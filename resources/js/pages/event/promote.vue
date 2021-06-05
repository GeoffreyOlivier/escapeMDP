<template>
  <div>
    <h1>Mon évènement</h1>
    <div>
      <div>Titre</div>
      <div>{{ events.title }}</div>
      <div>Description</div>
      <div>{{ events.description }}</div>
      <div>Catégories</div>
      <div>{{ events.event_type.name }}</div>
      <div>Sous catégories</div>
      <div v-if="events.event_game">
        <div v-for="(game,i) in events.event_game" :key="i">
          {{ game.name }}
        </div>
      </div>
      <div v-if="events.event_style">
        <div v-for="(style,i) in events.event_style" :key="i">
          {{ style.name }}
        </div>
      </div>
      <div v-if="events.event_sub_style">
        <div v-for="(sub_style,i) in events.event_sub_style" :key="i">
          {{ sub_style.sub_style_name }}
        </div>
      </div>
      <div v-if="events.event_sport">
        <div v-for="(sport,i) in events.event_sport" :key="i">
          {{ sport.name }}
        </div>
      </div>
      <div v-if="events.event_art">
        <div v-for="(art,i) in events.event_art" :key="i">
          {{ art.name }}
        </div>
      </div>
      <div>
        <div>{{events.price_one}}<p v-if="events.price_two"> • {{events.price_two}}</p>
          <p v-if="events.price_three"> • {{ events.price_three}}</p><p v-if="events.price_four"> • {{events.price_four}}</p></div>
      </div>
      <div>
        Date et heure
      </div>
      <div>
        {{events.start_at}}
        {{events.ending_at}}
      </div>
      <div>Localisation</div>
      <div>Lieu</div>
      <div>{{events.place}}</div>
      <div>Rue, avenue, lieu-dit</div>
      <div>{{events.address}}</div>
      <div>Code postal</div>
      <div>{{events.}}</div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'validate',
  data: () => ({
    events: ''
  }),
  created() {
    console.log("helllo")
    console.log(this.$route.params.id)
    this.fetchEvent()
  }
  ,
  methods: {
    fetchEvent() {
      this.$api.get('/event/validate/' + 15)
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
