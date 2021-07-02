<template>
  <div>
    <h1>Mon évènement</h1>
    <b-container>
      <b-row>

        <b-col>
          <div>
            <div class="label">Titre</div>
            <div class="answer">{{ events.title }}</div>
            <div class="label">Description</div>
            <div class="text-description">{{ events.description }}</div>
            <div class="display">
              <div>
                <div class="label">Catégories</div>
                <div class="event-type">{{ events.event_type.name }}</div>
              </div>
              <div class="ml-2">
                <div class="label">Sous catégories</div>
                <div v-if="events.event_game">
                  <div class="event-sub-type" v-for="(game,i) in events.event_game" :key="i">
                    {{ game.name }}
                  </div>
                </div>
                <div v-if="events.event_style">
                  <div class="event-sub-type" v-for="(style,i) in events.event_style" :key="i">
                    {{ style.name }}
                  </div>
                </div>
                <div>
                  <div class="event-sub-type" v-for="(sub_style,i) in events.event_sub_style" :key="i">
                    {{ sub_style.sub_style_name }}
                  </div>
                </div>
                <div v-if="events.event_sport">
                  <div class="event-sub-type" v-for="(sport,i) in events.event_sport" :key="i">
                    {{ sport.name }}
                  </div>
                </div>
                <div v-if="events.event_art">
                  <div class="event-sub-type" v-for="(art,i) in events.event_art" :key="i">
                    {{ art.name }}
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="label">Tarifs</div>
              <div class="answer">{{ events.price_one }}<span v-if="events.price_two"> • {{ events.price_two }}</span>
                <span v-if="events.price_three"> • {{ events.price_three }}</span>
                <span v-if="events.price_four"> • {{ events.price_four }}</span></div>
            </div>
            <div class="label">
              Date et heure
            </div>
            <div class="answer">
              {{ events.start_at | moment('lll') }} à
              {{ events.ending_at | moment('lll') }}
            </div>
            <div class="display">
              <div>
                <div class="label">Lieu</div>
                <div class="answer">{{ events.place }}</div>
                <div class="label">Rue, avenue, lieu-dit</div>
                <div class="answer">{{ events.address }}</div>
              </div>
              <div class="ml-3">
                <div class="label">Code postal</div>
                <div class="answer">{{ events.city.code_postal }}</div>
                <div class="label">Ville</div>
                <div class="answer">{{ events.city.nom_commune }}</div>
              </div>
            </div>


            <img class="img-card" :src="events.image_path" alt="bar">
            <div class="bottom">
              <v-button>
                Modifier
              </v-button>
              <v-button>
                Valider
              </v-button>
            </div>
          </div>
        </b-col>
        <b-col>
          <b-form @submit.prevent="submitForm">
            <div class="box">
              <h4>Options premium</h4>
              <div class="text">Afficher votre annonce automatiquement en haut de
                la liste des résultats "Rechercher" Avec le coût par clic
              </div>
              <b-form-group class="ml-3" v-slot="{ ariaDescribedby }">
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" class="text" name="some-radios" value="24">
                  Forfait 24 heures
                </b-form-radio>
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" class="text" name="some-radios" value="72">
                  Forfait 3 jours
                </b-form-radio>
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" class="text" name="some-radios" value="168">
                  Forfait 7 jours
                </b-form-radio>
                <p class="pink">En savoir +</p>
              </b-form-group>
            </div>
            <div>
              <v-button class="validate-btn">
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
      this.$api.get('/event/validate/' + 1)
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
      this.$api.post('/event/promote/' + this.$route.params.id, {selected: this.selected})
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
<style scoped>
.display {
  display: flex;
}

h1 {
  padding-bottom: 50px;
}
h4{
  color: #111D5E !important;
  font-size: medium;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;
}

.img-card {
  max-width: 400px;
  object-fit: cover;
  border-radius: 35px;
}
.text {
  color: #111D5E;
  font-family: Roboto, sans-serif;
  font-weight: 200;
  padding: 10px 0;
  font-size: smaller;
}
.box {
  background-color: #f4cdd6;
  padding: 25px 25px;
  width: 300px;
  border-radius: 35px;
}

.label {
  color: #111D5E !important;
  font-size: larger;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;
  padding: 10px 0;
}

.answer {
  color: #D70039 !important;
  font-size: small;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;
  padding: 10px 0;
}

.pink {
  color: #D70039 !important;
  font-size: small;
  font-family: Gobold_Extra2, serif;
  line-height: 30px;
  padding: 10px 0;
}

.text-description {
  padding: 20px 0;
  color: #111D5E !important;
  font-size: small;
  font-weight: bolder;
  font-family: roboto, serif;
}

.event-type {
  display: inline-block;
  border: 2px #D70039 solid;
  border-radius: 20px;
  color: #D70039;
  margin: 10px 10px;
  padding: 0px 10px;
}

.event-sub-type {
  display: inline-block;
  border: 2px #111D5E solid;
  border-radius: 20px;
  color: #111D5E;
  margin: 10px 10px;
  padding: 0px 10px;
}

.bottom {
  display: flex;
  max-width: fit-content;
}

.btn {
  margin: 20px 20px;
}

.validate-btn {
  text-align: center;
}
</style>
