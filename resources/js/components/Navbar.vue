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


        <ul class="navbar-nav ml-auto">
          <!-- Authenticated -->
          <li v-if="!user || promoter === 1">
            <router-link to="/events" class="nav-link">Rechercher</router-link>
          </li>
          <li v-if="!user || promoter === 1">
            <router-link to="#" class="nav-link">A propos</router-link>
          </li>
          <li v-if="!user || promoter === 1">
            <router-link to="/event/create" class="nav-link">Publier</router-link>
          </li>
          <li v-if="promoter === 0">
            <router-link to="my-feed" class="nav-link">Mon fil</router-link>
          </li>
          <li v-if="promoter === 0">
            <router-link to="#" class="nav-link">Agenda</router-link>
          </li>
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
             Mon compte
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

.nav-link {
  padding: 0 20px !important;
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
    appName: window.config.appName,
    promoter: ''
  }),
  created() {
    this.promoter = this.user.promoter
    console.log(this.promoter)
  },

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


