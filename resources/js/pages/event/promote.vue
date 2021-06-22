<template>
  <div>
    <b-container>
      <h1>Mon évènement</h1>
        <b-row>
          <b-col>
            <div>
              <div class="label">Titre</div>
              <div class="answer">{{ events.title }}</div>
              <div class="label">Description</div>
              <div class="text-description">{{ events.description }}</div>
              <div class="label">Catégories</div>
              <div class="event-type">{{ events.event_type.name }}</div>
              <div class="label">Sous catégories</div>
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
                <div>{{ events.price_one }}<p v-if="events.price_two"> • {{ events.price_two }}</p>
                  <p v-if="events.price_three"> • {{ events.price_three }}</p>
                  <p v-if="events.price_four"> • {{ events.price_four }}</p></div>
              </div>
              <div>
                Date et heure
              </div>
              <div>
                {{ events.start_at }}
                {{ events.ending_at }}
              </div>
              <div>Localisation</div>
              <div>Lieu</div>
              <div>{{ events.place }}</div>
              <div>Rue, avenue, lieu-dit</div>
              <div>{{ events.address }}</div>
              <div>Code postal</div>
              <div>{{ events.city.code_postal }}</div>
              <div>Ville</div>
              <div>{{ events.city.nom_commune }}</div>
              <img class="img-card" :src="events.image_path" alt="bar">
              <div class="bottom">
                <v-button class="center">
                  Modifier
                </v-button>
              </div>
              <div class="bottom">
                <v-button class="center">
                  Valider
                </v-button>
              </div>
            </div>
          </b-col>
          <b-col>
            <b-form @submit.prevent="submitForm">
            <div class="box">
              <h4>Options premium</h4>
              <div>Afficher votre annonce automatiquement en haut de
              la liste des résultats "Rechercher" Avec le coût par clic</div>
              <b-form-group label="Individual radios" v-slot="{ ariaDescribedby }">
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" name="some-radios" value="24">Forfait 24 heures</b-form-radio>
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" name="some-radios" value="72">Forfait 3 jours</b-form-radio>
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" name="some-radios" value="168">Forfait 7 jours</b-form-radio>
              </b-form-group>
            </div>
              <div class="bottom">
                <v-button class="center" >
                  Valider
                </v-button>
              </div>
            </b-form>
          </b-col>
        </b-row>

    </b-container>
  </div>
</template>
<script>
export default {
  name: 'validate',
  data: () => ({
    events: '',
    selected: ''
  }),
  created() {

    console.log("helllo")
    console.log(this.$route.params.id)
    this.fetchEvent()
  }
  ,
  methods: {
    fetchEvent() {
      this.$api.get('/event/validate/' + 2)
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
    },
    submitForm() {
      this.$api.post('/event/promote/' + this.$route.params.id, {selected: this.selected} )
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
.img-card {
  max-width: 200px;
  object-fit: cover;
  border-radius: 35px;
}
.box{
  background-color: rosybrown;
  height: 400px;
  width: 300px;
}
.label{
  color: #111D5E !important;
  font-size: medium;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;
}
.answer{
  color: #D70039 !important;
  font-size: medium;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;
}
.text-description{
  padding: 20px 0;
  color: #111D5E !important;
  font-size: small;
  font-weight: bolder;
  font-family: roboto, serif;
}
.event-type{
  display: inline-block;
  border: 2px #D70039 solid;
  border-radius: 20px;
  color: #D70039;
  margin: 10px 10px;
  padding: 0px 10px;
}
</style>
