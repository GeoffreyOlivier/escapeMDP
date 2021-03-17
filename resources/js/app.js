import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import axios from 'axios'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import EvaIcons from 'vue-eva-icons'

Vue.use(EvaIcons)

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import '~/plugins'
import '~/components'
Vue.filter('truncate', function (text, stop, clamp) {
  return text.slice(0, stop) + (stop < text.length ? clamp || '...' : '')
})
Vue.use({
  install (Vue) {
    Vue.prototype.$api = axios.create({
      baseURL: '/api'
    })
  }
})
Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
