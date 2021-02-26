<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
        <img src="../../images/V1.png" alt="logo" class="img-nav">
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <locale-dropdown />
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li> -->
        </ul>

        <ul class="navbar-nav ml-auto">
          <!-- Authenticated -->
          <li>
            <router-link to="/events" class="nav-link">Rechercher</router-link>
          </li>
          <li>
            <router-link to="#" class="nav-link">A propos</router-link>
          </li>
          <li>
            <router-link to="/event/create" class="nav-link">Publier</router-link>
          </li>
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              {{ user.name }}
            </a>
            <div class="dropdown-menu">
              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                <fa icon="cog" fixed-width />
                {{ $t('settings') }}
              </router-link>

              <div class="dropdown-divider" />
              <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width />
                {{ $t('logout') }}
              </a>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<style scoped>

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

.btn-primary {
  border-radius: 0;
  text-align: center;
  font-family: 'Gobold_Extra2';
  text-transform: uppercase;
  display: block;
  font-weight: bold;
  color: #fff;
  background: #D70039;
  border-color: #D70039;
  font-weight: bold;
  width: 30%;
  margin-top: 15px;
  padding: 5px 5px;
  font-size: 18px;
  letter-spacing: 1.5px;
}

h1 {
  /*transform: translate(-15px);*/
  font-family: 'Gobold_Extra2';
  text-transform: capitalize;
  color: #D70039;
  margin-bottom: 20px;
}

</style>
<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>


