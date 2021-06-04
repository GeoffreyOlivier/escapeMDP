<template>
  <div>
    <b-container>
      <h2>Mon évènement</h2>
      <b-form @submit.prevent="submitForm">
        <b-row>
          <b-col>
            <h3>Information</h3>
            <b-form-group id="title" label="Titre" class="add-style">
              <b-form-input
                id="example-input-1"
                name="example-input-1"
                v-model="form.title"
                aria-describedby="input-1-live-feedback"
              ></b-form-input>
              <div v-if="submitted && !$v.form.title.required" class="invalid-feedback">Le champs est obligatoire</div>
              <div v-if="submitted && !$v.form.title.minLength" class="invalid-feedback">Le champs doit faire au minimum 4 caractères</div>
            </b-form-group>

            <b-form-group id="description" label="Description" class="add-style">
              <b-form-input
                v-model="form.description"
                class="form-control" type="text" name="description"
              />
              <b-form-invalid-feedback
                id="input-1-live-feedback"
              >This is a required field and must be at least 3 characters.</b-form-invalid-feedback>
            </b-form-group>
            <input id="file" type="file" @change="processFile($event)">
            <b-form-group id="categorie" label="Catégorie" class="add-style mt-3">
              <b-form-select v-on:change="changeItem()" v-model="form.event_type_id"
                             :options="options_cat"></b-form-select>
            </b-form-group>
            <b-form-group v-if="form.event_type_id === '1'" id="Style" label="Style musicale" class="add-style">
              <VueFuse
                :list="styles"
                :fuse-opts="options"
                :search="search"
                :map-results="false"
                v-model="input_fuse"
                class="autocomplete-input"
                placeholder="Techno, Hip-Hop, Pop, ..."
                @fuse-results="handleResults"
              />

              <ul class="autocomplete-result-list">
                <li class="autocomplete-result"
                    v-for="(style, i) in results"
                    :key="i">
                  <div @click="add_style(style, 'music')"
                       class="list-group-item">
                    {{ style.item.sub_style_name }} - <span class="style">{{ style.item.name }}</span>
                  </div>
                </li>
              </ul>
              <div class="tag-style">
                <div>
                  <div v-for="sub_style_selected in sub_style_selecteds" :keys:="sub_style_selecteds.item">
                    <b-button class="btn-sub-style" variant="outline-primary"
                              @click="remove_sub_style(sub_style_selected)">
                      {{ sub_style_selected.item.sub_style_name }} X
                    </b-button>
                  </div>
                </div>
                <div>
                  <div v-for="style_selected in style_selecteds" :keys:="style_selecteds.id">
                    <b-button class="btn-style" variant="outline-secondary" @click="remove_style(style_selected)">
                      {{ style_selected.item.name }} X
                    </b-button>
                  </div>
                </div>
              </div>
            </b-form-group>
            <b-form-group v-if="form.event_type_id === '2'" id="game" label="Jeux" class="add-style">
              <VueFuse
                :list="game"
                :fuse-opts="options"
                :search="search"
                :map-results="false"
                class="autocomplete-input"
                placeholder="Société, en ligne, etc.."
                @fuse-results="handleResults"
              />

              <ul class="autocomplete-result-list">
                <li class="autocomplete-result"
                    v-for="(game, i) in results"
                    :key="i">
                  <div @click="add_game( game,'game')"
                       class="list-group-item">
                    {{ game.item.name }}
                  </div>
                </li>
              </ul>
              <div class="tag-style">
                <div>
                  <div v-for="game_selected in game_selecteds" :keys:="game_selecteds.item">
                    <b-button class="btn-sub-style" variant="outline-primary"
                              @click="add_game(game_selected)">
                      {{ game_selected.item.name }} X
                    </b-button>
                  </div>
                </div>
              </div>
            </b-form-group>
            <b-form-group v-if="form.event_type_id === '3'" id="art" label="Art et culture" class="add-style">
              <VueFuse
                :list="art"
                :fuse-opts="options"
                :search="search"
                :map-results="false"
                class="autocomplete-input"
                placeholder="Festival, Danse, Exposition, ..."
                @fuse-results="handleResults"
              />

              <ul class="autocomplete-result-list">
                <li class="autocomplete-result"
                    v-for="(art, i) in results"
                    :key="i">
                  <div @click="add_art( art,'art')"
                       class="list-group-item">
                    {{ art.item.name }}
                  </div>
                </li>
              </ul>
              <div class="tag-style">
                <div>
                  <div v-for="art_selected in art_selecteds" :keys:="art_selecteds.item">
                    <b-button class="btn-sub-style" variant="outline-primary"
                              @click="add_art(art_selected)">
                      {{ art_selected.item.name }} X
                    </b-button>
                  </div>
                </div>
              </div>
            </b-form-group>
            <b-form-group v-if="form.event_type_id === '4'" id="sport" label="Sport" class="add-style">
              <VueFuse
                :list="sport"
                :fuse-opts="options"
                :search="search"
                :map-results="false"
                class="autocomplete-input"
                placeholder="Tennis, Foot, Course à pied, ..."
                @fuse-results="handleResults"
              />

              <ul class="autocomplete-result-list">
                <li class="autocomplete-result"
                    v-for="(sport, i) in results"
                    :key="i">
                  <div @click="add_sport( sport,'sport')"
                       class="list-group-item">
                    {{ sport.item.name }}
                  </div>
                </li>
              </ul>
              <div class="tag-style">
                <div>
                  <div v-for="sport_selected in sport_selecteds" :keys:="sport_selecteds.item">
                    <b-button class="btn-sub-style" variant="outline-primary"
                              @click="add_sport(sport_selected)">
                      {{ sport_selected.item.name }} X
                    </b-button>
                  </div>
                </div>
              </div>
            </b-form-group>
            <b-form-group id="price" label="Premier tarif"  class="add-style">
              <b-form-input
                placeholder="Sur place : 45€"
                v-model="form.price_one"
                class="form-control" type="text" name="price"
              />
            </b-form-group>
            <b-form-group  v-if="form.price_one !== ''" id="price" label="Deuxième tarif " class="add-style">
              <b-form-input
                placeholder="Early Bird : 35€"
                v-model="form.price_two"
                class="form-control" type="text" name="price"
              />
            </b-form-group>
            <b-form-group v-if="form.price_two !== ''" id="price" label="Troisème tarif" class="add-style">
              <b-form-input
                v-model="form.price_three"
                class="form-control" type="text" name="price"
              />
            </b-form-group>
            <b-form-group  v-if="form.price_three !== ''" id="price" label="Quatrième tarif" class="add-style">
              <b-form-input
                v-model="form.price_four"
                class="form-control" type="text" name="price"
              />
            </b-form-group>
            <b-row>
              <b-col class="col-7">
                <b-form-checkbox
                  type="checkbox"
                id="customSwitch1" v-model="form.need_subscribe" switch >
                  Sur réservation ?
                </b-form-checkbox>
              </b-col>
              <b-col class="col-5">
                <b-form-group id="nb_people_max" class="add-style">
                  <b-form-input
                    :disabled="form.need_subscribe === false"
                    placeholder="Nombre de place"
                    v-model="form.nb_people_max"
                    class="form-control" type="text" name="nb_people_max"
                  />
                </b-form-group>
              </b-col>
            </b-row>

            <b-form-group id="date_start" label="Date et heure début" class="add-style">
              <b-form-input
                v-model="form.start_at"
                class="form-control" type="datetime-local" name="date"
              />
            </b-form-group>
            <b-form-group id="date_end" label="Date et heure fin" class="add-style">
              <b-form-input
                v-model="form.ending_at"
                class="form-control" type="datetime-local" name="date"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <h3>Localisation</h3>
            <b-form-group id="place" label="Lieu" class="add-style">
              <b-form-input
                v-model="form.place"
                class="form-control" type="text" name="place"
              />
            </b-form-group>
            <b-form-group id="address" label="Adresse" class="add-style">
              <b-form-input
                v-model="form.address"
                class="form-control" type="text" name="address"
              />
            </b-form-group>
            <b-form-group id="code" label="Code postal" class="add-style">
              <b-form-input
                v-model="code"
                class="form-control" type="text" name="town"
              />
            </b-form-group>
            <b-form-group id="town" label="Ville" class="add-style">
            <b-form-select v-model="form.city" :options="cities" :select-size="3">
              <div class="mt-3">Selected: <strong>{{ form.city }}</strong></div>
            </b-form-select>
            </b-form-group>

          </b-col>
        </b-row>
        <div class="bottom">
          <v-button class="center" :loading="form.busy">
            Valider
          </v-button>
        </div>

      </b-form>
    </b-container>
  </div>
</template>

<script>
import { required, minLength } from "vuelidate/lib/validators";
import Form from 'vform'
import VueFuse from "../components/fuse";
import {LOGOUT} from "../../store/mutation-types";


export default {
  name: 'App',
  components: {
    VueFuse,
  },
  data: () => ({
    advanced: false,
    search: '',
    includeScore: false,
    results: [],
    styles: [],
    style_selecteds: [],
    sport_selecteds: [],
    game_selecteds: [],
    art_selecteds: [],
    sub_style_selecteds: [],
    code_selecteds: [],
    input_search: false,
    input: '',
    input_fuse: '',
    selected: 'null',
    game: [],
    art: [],
    sport: [],
    cities: [],
    code: '35',
    city_result: [],
    submitted: false,
    options_cat: [
      {value: 'null', text: 'Choisir une option'},
      {value: '1', text: 'Musique'},
      {value: '2', text: 'Jeux'},
      {value: '3', text: 'Art et culture'},
      {value: '4', text: 'Sport'}
    ],
    form: {
      title: '',
      description: '',
      start_at: '',
      ending_at: '',
      nb_people_max: '',
      need_subscribe: false,
      price_one: '',
      price_two: '',
      price_three: '',
      price_four: '',
      place: '',
      address: '',
      city: '',
      event_type_id: '',
      image: null
    }
  }),
  computed: {
    options() {
      return {
        keys: [
          'name',
          'sub_style_name',
          'code_postal'
        ],
        includeScore: this.includeScore,
        threshold: 0.4
      }
    },
  },
  created() {
    this.fetchStyle()
    this.fetchArt()
    this.fetchGame()
    this.fetchSport()
    this.fetchCity()
    console.log(this.form.need_subscribe)
  },
  watch: {
    code(value) {
      if (value.length === 5) {
        this.city_result = this.city.filter(e => e.code_postal === value)

        for (let i = 0; i < this.city_result.length; i++) {
          this.cities.push(
            {
              value: this.city_result[i].id,
              text: this.city_result[i].nom_commune
            }
          )
        }
        console.log(this.cities)
        console.log(this.form.city)
      }if (value.length < 5) {
        console.log("pass if")
        if(this.cities){
          this.cities = []
        }
        console.log(this.form.city)

      }
      // this.form.city = value;
      console.log(this.form.city)
    }
  },
  validations: {
    form: {
      title: { required, minLength: minLength(3)},
    }
  },
  methods: {
    changeItem: function changeItem() {
      console.log("ok")
      this.input_fuse = ''
    },
    add_sport(v, c) {
      if (this.sport_selecteds.includes(v)) {
        this.sport_selecteds.splice(this.sport_selecteds.indexOf(v), 1)
      } else {
        this.sport_selecteds.push(v)
      }
    },
    add_game(v, c) {
      if (this.game_selecteds.includes(v)) {
        this.game_selecteds.splice(this.game_selecteds.indexOf(v), 1)
      } else {
        this.game_selecteds.push(v)
      }
    },
    add_style(v, c) {
      if (!this.style_selecteds.find(e => e.item.id === v.item.id)) {
        console.log(this.style_selecteds)
        console.log("pass double")
        this.style_selecteds.push(v)
        console.log(this.style_selecteds)
      }
      if (this.sub_style_selecteds.includes(v)) {
        this.sub_style_selecteds.splice(this.sub_style_selecteds.indexOf(v), 1)
      } else {
        this.sub_style_selecteds.push(v)
      }
    },
    add_art(v, c) {
      if (this.art_selecteds.includes(v)) {
        this.art_selecteds.splice(this.art_selecteds.indexOf(v), 1)
      } else {
        this.art_selecteds.push(v)
      }
      console.log(this.code_selecteds)
    },
    remove_sub_style(v) {
      const nb_of_style = this.sub_style_selecteds.filter(item => item.item.name === v.item.name).length;
      if (nb_of_style < 2) {
        let style_selecteds_trash = this.style_selecteds.indexOf(v.item.name)
        this.style_selecteds.splice(style_selecteds_trash, 1)
      }
      let sub_tyle_selecteds_trash = this.sub_style_selecteds.indexOf(v)
      this.sub_style_selecteds.splice(sub_tyle_selecteds_trash, 1)
    },
    remove_style(v) {
      const array_tmp = this.sub_style_selecteds.filter(item => item.item.name === v.item.name)
      for (var i = 0; i < array_tmp.length; i++) {
        this.sub_style_selecteds.splice(this.sub_style_selecteds.indexOf(array_tmp[i]), 1)
      }
      this.style_selecteds.splice(this.style_selecteds.indexOf(v), 1)
    },
    handleResults(r) {
      this.results = r
    },
    fetchStyle() {
      this.$api.get('/style')
        .then((response) => {
          this.styles = response.data
        })
        .catch((error) => {
          this.loading = false
        })
    },
    fetchSport() {
      this.$api.get('/sport')
        .then((response) => {
          console.log(response)
          this.sport = response.data
        })
        .catch((error) => {
          this.loading = false
        })
    },
    fetchArt() {
      this.$api.get('/art')
        .then((response) => {
          this.art = response.data
        })
        .catch((error) => {
          this.loading = false
        })
    },
    fetchGame() {
      this.$api.get('/game')
        .then((response) => {
          this.game = response.data
        })
        .catch((error) => {
          this.loading = false
        })
    },
    fetchCity() {
      this.$api.get('/city')
        .then((response) => {
          this.city = response.data
        })
        .catch((error) => {
          this.loading = false
        })
    },
    CreateEvent() {
      // Submit the form.
      console.log("pass")
      console.log(this.form)
      // this.$api.post('/event/create', this.form).then(response => {
      //     console.log(response)
      //   }
      // ).catch(err => {
      //   console.log(err)
      // })
      // // Redirect home.
      // this.$router.push('/events')
    },
    processFile(event) {
      this.form.image = event.target.files[0]
    },
    submitForm() {
      // this.$v.form.$touch();
      // if (this.$v.form.$invalid) {
      //   return;
      // }
      //
      // alert("Form submitted!");
      this.submitted = false
      const formData = new FormData()

      formData.append('image', this.form.image)
      formData.append('title', this.form.title)
      formData.append('description', this.form.description)
      formData.append('start_at', this.form.start_at)
      formData.append('ending_at', this.form.ending_at)
      formData.append('nb_people_max', this.form.nb_people_max)
      formData.append('need_subscribe', this.form.need_subscribe)
      formData.append('price_one', this.form.price_one)
      formData.append('price_two', this.form.price_two)
      formData.append('price_three', this.form.price_three)
      formData.append('price_four', this.form.price_four)
      formData.append('place', this.form.place)
      formData.append('address', this.form.address)
      formData.append('city', this.form.city)
      formData.append('event_type_id', this.form.event_type_id)


      console.log(this.form)
      console.log(this.form.city)
      console.log('before axios')
      this.$api.post('/event/create', formData)
        .then((res) => {
          console.log('success')
          this.associate(res.data[0])
        })
        .catch((error) => {
          console.log('error')
          console.log(error)
        })
    },
    associate(v) {
      switch (this.form.event_type_id) {
        case '4':
          for (let i = 0; i < this.sport_selecteds.length; i++) {
            this.$api.post('event/sport', {event_id: v, sport_id: this.sport_selecteds[i].item.id})
              .then((res) => {
                console.log("sport")
                console.log('success')
                console.log(res)
              })
              .catch((error) => {
                console.log("sport")
                console.log('error')
                console.log(error)
              })
          }
          break;
        case '2':
          for (let i = 0; i < this.game_selecteds.length; i++) {
            this.$api.post('event/game', {event_id: v, game_id: this.game_selecteds[i].item.id})
              .then((res) => {
                console.log("game")
                console.log(this.game_selecteds[i])
                console.log('success')
                console.log(res)
              })
              .catch((error) => {
                console.log("game")
                console.log('error')
                console.log(error)
              })
          }
          break;
        case '3':
          for (let i = 0; i < this.art_selecteds.length; i++) {
            this.$api.post('event/art', {event_id: v, cultural_journey_id: this.art_selecteds[i].item.id})
              .then((res) => {
                console.log("art")
                console.log('success')
                console.log(res)
              })
              .catch((error) => {
                console.log("art")
                console.log('error')
                console.log(error)
              })
          }
          break;
        case '1':
          for (let i = 0; i < this.style_selecteds.length; i++) {
            this.$api.post('event/style', {event_id: v, style_id: this.style_selecteds[i].item.id})
              .then((res) => {
                console.log("music")
                console.log('success')
                console.log(res)
              })
              .catch((error) => {
                console.log("music")
                console.log('error')
                console.log(error)
              })
          }
          for (let i = 0; i < this.sub_style_selecteds.length; i++) {
            this.$api.post('event/substyle', {event_id: v, sub_style_id: this.sub_style_selecteds[i].item.id})
              .then((res) => {
                console.log("substyle")
                console.log('success')
                console.log(res)
              })
              .catch((error) => {
                console.log("substyle")
                console.log('error')
                console.log(error)
              })
          }
          break;
        default:
          console.log(`Sorry, we are out of expression.`);
      }
    },


  },


}
</script>
<style>
.bottom{
  height: 100px;
  position: relative;
}
.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}



.custom-control-input:checked ~
.custom-control-label::before {
  border-color: #111D5E !important;
  background-color: #111D5E !important;
}


h3{
  font-family: 'Gobold_Extra2';
  color: #111D5E;
  padding-bottom: 25px;
}
.col-form-label{
  font-family: 'Gobold_Extra2';
  color: #111D5E;
}
.btn-style {
  color: #000000;
  border-color: #111D5E;
  margin: 2px 0;
}

.btn-style:hover {
  color: #fff;
  background-color: #111D5E;
  border-color: #111D5E;
}

.btn-sub-style {
  color: #D70039;
  border-color: #D70039;
  margin: 2px 0;
}

.btn-sub-style:hover {
  color: #fff;
  border-color: #D70039;
  background-color: #D70039;
}

.btn {
  border-radius: 25px;
}

.tag-style {
  display: flex;
  justify-content: space-between;

}

.login-container {
  padding: 50px 10px;
}

.autocomplete-result-list {
  margin-left: -40px;
  overflow: auto;
  list-style-type: none;
  max-height: 200px;
}

.autocomplete-result-list-city {
  margin-left: -40px;
  overflow: auto;
  list-style-type: none;
  max-height: 100px;
}

h2 {
  font-family: Roboto, sans-serif;;
  text-transform: uppercase;
  color: #D70039;
}

h3 {
  padding-top: 10px;
}

.create-account, .login-account {
  /*padding: 30px 0;*/

}

.create-account {
  padding: 20px 26px;
}

.login-account {
  padding: 20px 26px;
}

form {
  margin-top: 25px;

}

.legend {
  color: #111D5E;
  font-family: 'Roboto', serif;
  font-size: x-large;
}

h1 {
  /*transform: translate(-15px);*/
  font-family: 'Gobold_Extra2';
  text-transform: capitalize;
  color: #D70039;
  margin-bottom: 20px;
}

</style>
