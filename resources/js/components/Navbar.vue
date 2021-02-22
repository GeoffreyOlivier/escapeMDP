<!--<template>-->

<!--  <nav class="navbar navbar-expand-lg navbar-light bg-white">-->
<!--    <div class="container">-->
<!--      <div id="navbarToggler" class="collapse navbar-collapse text-center">-->
<!--&lt;!&ndash;        <ul class="navbar-nav">&ndash;&gt;-->
<!--&lt;!&ndash;          <img src="../../images/V1.png" class="img-nav">&ndash;&gt;-->
<!--&lt;!&ndash;        </ul>&ndash;&gt;-->
<!--        <ul class="navbar-nav ml-auto">-->
<!--&lt;!&ndash;          <b-nav-item class="nav-link" href="#">Rechercher</b-nav-item>&ndash;&gt;-->
<!--&lt;!&ndash;          <b-nav-item class="nav-link" href="#">A propos</b-nav-item>&ndash;&gt;-->
<!--&lt;!&ndash;          <b-nav-item class="nav-link" href="#">publier</b-nav-item>&ndash;&gt;-->
<!--          &lt;!&ndash; Authenticated &ndash;&gt;-->
<!--          <li v-if="user" class="nav-link dropdown">-->
<!--            <a class="nav-link dropdown-toggle link-nav"-->
<!--               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"-->
<!--            >-->
<!--              {{ user.name }}-->
<!--            </a>-->
<!--            <div class="dropdown-menu">-->
<!--              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">-->
<!--                <fa icon="cog" fixed-width/>-->
<!--                {{ $t('settings') }}-->
<!--              </router-link>-->

<!--              <div class="dropdown-divider"/>-->
<!--              <a href="#" class="dropdown-item pl-3" @click.prevent="logout">-->
<!--                <fa icon="sign-out-alt" fixed-width/>-->
<!--                {{ $t('logout') }}-->
<!--              </a>-->
<!--            </div>-->
<!--          </li>-->
<!--          &lt;!&ndash; Guest &ndash;&gt;-->
<!--          <template v-else>-->
<!--            <li class="nav-link">-->
<!--              <router-link :to="{ name: 'login' }" class="nav-link" >-->
<!--                {{ $t('login') }}-->
<!--              </router-link>-->
<!--            </li>-->
<!--          </template>-->
<!--        </ul>-->
<!--      </div>-->
<!--    </div>-->
<!--  </nav>-->
<!--</template>-->
<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <router-link :to="{ name: user ? 'home' : 'welcome' }" class="navbar-brand">
        {{ appName }}
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon" />
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse nav-item">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Rechercher</a>
          </li>
          <li>
            <a class="nav-link" href="#">A propos</a>
          </li>
          <li>
            <a class="nav-link" href="#">publier</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            >
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
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
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>
<style scoped>
.nav-item{
  color: #111D5E;
  display: flex;
  justify-items: end;
}
.img-nav{
  width: 50px;
  height: auto;
}

</style>
<script>
import { mapGetters } from 'vuex'
// import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
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


