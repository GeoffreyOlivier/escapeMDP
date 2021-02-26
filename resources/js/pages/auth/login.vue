<template>
  <div>
    <b-container>
      <h1>Mon compte</h1>
      <b-row>
        <b-col sm class="login-account col-sm-6 order-sm-12">
          <h2>Connexion</h2>
          <b-form @submit.prevent="login" @keydown="formlogin.onKeydown($event)">
            <b-form-group label="Mail" class="add-style">
              <b-form-input
                v-model="formlogin.email" :class="{ 'is-invalid': formlogin.errors.has('email') }" class="form-control"
                type="email" name="email"
              />
              <has-error :form="formlogin" field="email" />
            </b-form-group>
            <b-form-group label="Mot de passe" class="add-style">
              <b-form-input
                v-model="formlogin.password" :class="{ 'is-invalid': formlogin.errors.has('password') }"
                class="form-control" type="password" name="password"
              />
              <has-error :form="formlogin" field="password" />
            </b-form-group>
            <v-button :loading="formlogin.busy">
              {{ $t('login') }}
            </v-button>
            <!-- Remember Me -->
            <checkbox v-model="remember" name="remember">
              {{ $t('remember_me') }}
            </checkbox>
            <!-- forgot password -->
            <router-link :to="{ name: 'password.request' }" class="small ml-auto my-auto">
              {{ $t('forgot_password') }}
            </router-link>
          </b-form>
        </b-col>
        <!----------------------- Register user ----------------->
        <b-col sm class="create-account col-sm-6 order-sm-1">
          <h2>Création de compte</h2>
          <b-form @submit.prevent="registerPromoter" @keydown="form.onKeydown($event)">
            <b-form-group id="lastname" label="Nom*" class="add-style">
              <b-form-input
                v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"
                class="form-control" type="text" name="name"
                required
              />
            </b-form-group>
            <b-form-group id="input-group-2" label="Mail" class="add-style">
              <b-form-input
                v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }"
                class="form-control" type="email" name="email"
                required
              />
            </b-form-group>
            <b-form-group class="add-style" label="Mot de passe">
              <b-form-input
                v-model="form.password"
                :class="{ 'is-invalid': form.errors.has('password') }" class="form-control"
                type="password" name="password"
                required
              />
            </b-form-group>
            <b-form-group class="add-style" label="Confirmation">
              <b-form-input
                v-model="form.password_confirmation"
                :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control"
                type="password" name="password_confirmation"
                required
              />
            </b-form-group>
            <b-form-group id="town" label="Ville / Commune" class="add-style">
              <b-form-input
                v-model="form.town" :class="{ 'is-invalid': form.errors.has('town') }"
                class="form-control" type="text" name="town"
                required
              />
            </b-form-group>
            <b-form-checkbox v-model="form.promoter" switch size="lg">
              Vous êtes un créateur d'évenement ?
            </b-form-checkbox>
            <b-form-group v-if="form.promoter" id="email" label="Rue, avenue, lieu-dit*" class="add-style">
              <b-form-input
                v-model="form.street"
                :class="{ 'is-invalid': form.errors.has('street') }" class="form-control" type="text"
                name="street"
                required
              />
            </b-form-group>
            <b-form-group v-if="form.promoter" id="firstname" label="Nom de l'entreprise, association" class="add-style">
              <b-form-input
                v-model="form.entreprise"
                :class="{ 'is-invalid': form.errors.has('entreprise') }" class="form-control"
                type="text" name="entreprise"
                required
              />
            </b-form-group>
            <b-form-group v-if="form.promoter" id="input-group-2" label="Téléphone" class="add-style">
              <b-form-input
                v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }"
                class="form-control" type="text" name="phone"
                required
              />
            </b-form-group>
            <b-form-group v-if="form.promoter" id="input-group-2" label="Siret" class="add-style">
              <b-form-input
                v-model="form.siret" :class="{ 'is-invalid': form.errors.has('siret') }"
                class="form-control" type="text" name="siret"
                required
              />
            </b-form-group>
            <b-form-group v-if="form.promoter" id="input-group-2" label="Site Web" class="add-style">
              <b-form-input
                v-model="form.site" :class="{ 'is-invalid': form.errors.has('site') }"
                class="form-control" type="text" name="site"
                required
              />
            </b-form-group>
            <b-form-group v-if="form.promoter" id="input-group-2" label="Réseaux sociaux" class="add-style">
              <b-form-input
                v-model="form.social"
                :class="{ 'is-invalid': form.errors.has('social') }" class="form-control" type="text"
                name="social"
                required
              />
            </b-form-group>
            <v-button :loading="formlogin.busy">
              {{ $t('register') }}
            </v-button>
          </b-form>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<style>
.login-container {
  padding: 50px 10px;
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

input {
  display: block;
  background-color: #e3e3e3;
  border-radius: 0;
  border: 0;
  width: 75%;
}

@media screen and (max-width: 640px) {
  input {
    width: 100%;
  }
}

</style>
<script>
import Form from 'vform'
import Cookies from 'js-cookie'

export default {
  middleware: 'guest',

  // metaInfo () {
  //   return { title: this.$t('login') }
  // },
  data: () => ({
    formlogin: new Form({
      email: '',
      password: ''
    }),
    remember: false,
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      entreprise: '',
      siret: '',
      street: '',
      town: '',
      code: '',
      phone: '',
      acept: false,
      site: '',
      selected: '',
      social: '',
      promoter: false
    }),
    mustVerifyEmail: false
  }),
  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.formlogin.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.redirect()
    },
    async registerPromoter () {
      // Register the user.
      console.log(this.form)
      const { data } = await this.form.post('/api/register')
      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')
        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })
        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })
        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    },
    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
