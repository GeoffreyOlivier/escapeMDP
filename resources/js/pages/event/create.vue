<template>
  <div>
    <b-container>
      <b-row>
        <b-form enctype="multipart/form-data" @submit.prevent="submitForm">
          <h1>Mon évènement</h1>
          <b-col>
            <b-form-group id="title" label="Titre" class="add-style">
              <b-form-input
                v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }"
                class="form-control" type="text" name="title"
              />
            </b-form-group>
            <b-form-group id="description" label="Description" class="add-style">
              <b-form-input
                v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }"
                class="form-control" type="text" name="description"
              />
            </b-form-group>
            <b-form-group id="price" label="Tarif" class="add-style">
              <b-form-input
                v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }"
                class="form-control" type="text" name="price"
              />
            </b-form-group>
            <b-form-group id="date" label="Date et heure début" class="add-style">
              <b-form-input
                v-model="form.start_at" :class="{ 'is-invalid': form.errors.has('date') }"
                class="form-control" type="datetime-local" name="date"
              />
            </b-form-group>
            <b-form-group id="date" label="Date et heure fin" class="add-style">
              <b-form-input
                v-model="form.ending_at" :class="{ 'is-invalid': form.errors.has('date') }"
                class="form-control" type="datetime-local" name="date"
              />
            </b-form-group>
            <b-form-group id="nb_people_max" label="Nombre de personnes maximum" class="add-style">
              <b-form-input
                v-model="form.nb_people_max" :class="{ 'is-invalid': form.errors.has('nb_people_max') }"
                class="form-control" type="text" name="nb_people_max"
              />
            </b-form-group>
<!--            <b-form-file-->
<!--              v-model="form.image"-->
<!--              :state="Boolean(form.image)"-->
<!--              placeholder="Choose a file or drop it here..."-->
<!--              drop-placeholder="Drop file here..."-->
<!--            ></b-form-file>-->
<!--            <div class="mt-3">Selected file: {{ form.image ? form.image.name : '' }}</div>-->
            <input id="file" type="file" @change="processFile($event)">
            <!--            <b-form-checkbox v-model="form.need_subscribe" switch size="lg">-->
            <!--              Sur réservation ?-->
            <!--            </b-form-checkbox>-->
            <b-form-checkbox
              id="checkbox-1"
              v-model="form.need_subscribe"
              name="checkbox-1"
              value="accepted"
              unchecked-value="not_accepted"
            >
              Sur réservation ?
            </b-form-checkbox>
            <b-form-group id="place" label="Lieu" class="add-style">
              <b-form-input
                v-model="form.place" :class="{ 'is-invalid': form.errors.has('place') }"
                class="form-control" type="text" name="place"
              />
            </b-form-group>
            <b-form-group id="address" label="Adresse" class="add-style">
              <b-form-input
                v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }"
                class="form-control" type="text" name="address"
              />
            </b-form-group>
            <b-form-group id="street" label="Rue, Avenue, lieu dit" class="add-style">
              <b-form-input
                v-model="form.street" :class="{ 'is-invalid': form.errors.has('street') }"
                class="form-control" type="text" name="street"
              />
            </b-form-group>
            <b-form-group id="town" label="Ville" class="add-style">
              <b-form-input
                v-model="form.town" :class="{ 'is-invalid': form.errors.has('town') }"
                class="form-control" type="text" name="town"
              />
            </b-form-group>
            <v-button :loading="form.busy">
              Valider
            </v-button>
          </b-col>
          <b-col />
        </b-form>
      </b-row>
    </b-container>
  </div>
</template>
<style>
.login-container {
  padding: 50px 10px;
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

/*h1 {*/
/*  !*transform: translate(-15px);*!*/
/*  font-family: 'Gobold_Extra2';*/
/*  text-transform: capitalize;*/
/*  color: #D70039;*/
/*  margin-bottom: 20px;*/
/*}*/

</style>
<script>

import Form from 'vform'

export default {
  data: () => ({
    form: new Form({
      title: '',
      description: '',
      start_at: '',
      ending_at: '',
      nb_people_max: '',
      need_subscribe: '',
      price: '',
      place: '',
      address: '',
      street: '',
      town: '',
      image: null
    })
  }),
  methods: {
    CreateEvent () {
      // Submit the form.
      console.log(this.form)
      this.$api.post('/event/create', this.form).then(response => {
        console.log(response)
      }
      ).catch(err => {
        console.log(err)
      })
      // Redirect home.
      this.$router.push('/events')
    },
    processFile(event) {
      this.form.image = event.target.files[0]
    },
    submitForm () {

      const formData = new FormData()

      formData.append(' image', this.form.image)
      formData.append('title', this.form.title)
      formData.append('description', this.form.description)
      formData.append('start_at', this.form.start_at)
      formData.append('ending_at', this.form.ending_at)
      formData.append('nb_people_max', this.form.nb_people_max)
      formData.append('price', this.form.price)
      formData.append('place', this.form.place)
      formData.append('address', this.form.address)
      formData.append('street', this.form.street)
      formData.append('address', this.form.address)
      formData.append('town', this.form.town)

      console.log('before axios')
      this.$api.post('/event/create', formData)
        .then((res) => {
          console.log('success')
          console.log(res)
        })
        .catch((error) => {
          console.log('error')
          console.log(error)
        })
      console.log('after axios')
    }
  }

}
</script>
