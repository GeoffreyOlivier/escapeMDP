<template>
  <div class="container body-height">
    <h1>test</h1>
    <StackGrid
      class="monitor-images-loaded"
      :columnWidth="200"
      :gutterX="20"
      :gutterY="20"
      v-if="isLoading"
    >
      <div class="stack-item " v-for="(item, id) in events" :key="id">
        <div class="container-img">
          <router-link :to="{ name: 'anevent', params: { id: item.id } }">
          <img class="img-card" :src="item.image_path" alt="bar">
          </router-link>
          <div class="bar-icon">
            <svg v-if="loading === item.id" width="24" height="24" class="filter-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="more-horizotnal"><rect opacity="0"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/><circle cx="5" cy="12" r="2"/></g></g></svg>
            <svg v-if="item.liked !== 1 && loading !== item.id " @click="interests('like', item)" class="filter-svg"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <g data-name="Layer 2">
                <g data-name="heart">
                  <rect opacity="0"/>
                  <path
                    d="M12 21a1 1 0 0 1-.71-.29l-7.77-7.78a5.26 5.26 0 0 1 0-7.4 5.24 5.24 0 0 1 7.4 0L12 6.61l1.08-1.08a5.24 5.24 0 0 1 7.4 0 5.26 5.26 0 0 1 0 7.4l-7.77 7.78A1 1 0 0 1 12 21zM7.22 6a3.2 3.2 0 0 0-2.28.94 3.24 3.24 0 0 0 0 4.57L12 18.58l7.06-7.07a3.24 3.24 0 0 0 0-4.57 3.32 3.32 0 0 0-4.56 0l-1.79 1.8a1 1 0 0 1-1.42 0L9.5 6.94A3.2 3.2 0 0 0 7.22 6z"/>
                </g>
              </g>
            </svg>
            <svg v-if="item.liked === 1 && loading !== item.id " @click="interests('like', item)" class="filter-svg" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="heart"><rect  opacity="0"/><path d="M12 21a1 1 0 0 1-.71-.29l-7.77-7.78a5.26 5.26 0 0 1 0-7.4 5.24 5.24 0 0 1 7.4 0L12 6.61l1.08-1.08a5.24 5.24 0 0 1 7.4 0 5.26 5.26 0 0 1 0 7.4l-7.77 7.78A1 1 0 0 1 12 21z"/></g></g></svg>
            <svg v-if="item.booked !== 1 && loading !== item.id " @click="interests('book', item)" class="filter-svg"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <g data-name="Layer 2">
                <g data-name="bell">
                  <rect opacity="0"/>
                  <path
                    d="M20.52 15.21l-1.8-1.81V8.94a6.86 6.86 0 0 0-5.82-6.88 6.74 6.74 0 0 0-7.62 6.67v4.67l-1.8 1.81A1.64 1.64 0 0 0 4.64 18H8v.34A3.84 3.84 0 0 0 12 22a3.84 3.84 0 0 0 4-3.66V18h3.36a1.64 1.64 0 0 0 1.16-2.79zM14 18.34A1.88 1.88 0 0 1 12 20a1.88 1.88 0 0 1-2-1.66V18h4zM5.51 16l1.18-1.18a2 2 0 0 0 .59-1.42V8.73A4.73 4.73 0 0 1 8.9 5.17 4.67 4.67 0 0 1 12.64 4a4.86 4.86 0 0 1 4.08 4.9v4.5a2 2 0 0 0 .58 1.42L18.49 16z"/>
                </g>
              </g>
            </svg>
            <svg v-if="item.booked === 1 && loading !== item.id " @click="interests('book', item)" class="filter-svg" width="24" height="24"
                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g data-name="Layer 2">
                <g data-name="bell">
                  <rect opacity="0"/>
                  <path
                    d="M20.52 15.21l-1.8-1.81V8.94a6.86 6.86 0 0 0-5.82-6.88 6.74 6.74 0 0 0-7.62 6.67v4.67l-1.8 1.81A1.64 1.64 0 0 0 4.64 18H8v.34A3.84 3.84 0 0 0 12 22a3.84 3.84 0 0 0 4-3.66V18h3.36a1.64 1.64 0 0 0 1.16-2.79zM14 18.34A1.88 1.88 0 0 1 12 20a1.88 1.88 0 0 1-2-1.66V18h4z"/>
                </g>
              </g>
            </svg>
            <svg v-if="item.joined !== 1 && loading !== item.id " @click="interests('join', item)" class="filter-svg"
                 xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <g data-name="Layer 2">
                <g data-name="person">
                  <rect width="24" height="24" opacity="0"/>
                  <path d="M12 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4zm0-6a2 2 0 1 1-2 2 2 2 0 0 1 2-2z"/>
                  <path d="M12 13a7 7 0 0 0-7 7 1 1 0 0 0 2 0 5 5 0 0 1 10 0 1 1 0 0 0 2 0 7 7 0 0 0-7-7z"/>
                </g>
              </g>
            </svg>
            <svg v-if="item.joined === 1 && loading !== item.id " @click="interests('join', item)" class="filter-svg" width="24" height="24"
                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <g data-name="Layer 2">
                <g data-name="person-done">
                  <rect opacity="0"/>
                  <path
                    d="M21.66 4.25a1 1 0 0 0-1.41.09l-1.87 2.15-.63-.71a1 1 0 0 0-1.5 1.33l1.39 1.56a1 1 0 0 0 .75.33 1 1 0 0 0 .74-.34l2.61-3a1 1 0 0 0-.08-1.41z"/>
                  <path d="M10 11a4 4 0 1 0-4-4 4 4 0 0 0 4 4z"/>
                  <path d="M16 21a1 1 0 0 0 1-1 7 7 0 0 0-14 0 1 1 0 0 0 1 1"/>
                </g>
              </g>
            </svg>
          </div>

        </div>

        <div class="color" :class="{blue: id%2 === 0}">
          <h6>{{ item.title }}</h6>
          <p>{{ item.start_at | moment('ll') }} / {{ item.place }}</p>
          <p v-if="item.price">{{ item.price }}€</p>
          <p v-if="item.price === 0  || !item.price">Gratuit</p>
          <!--          <p>{{item.event_type.name}}</p>-->
        </div>
      </div>
    </StackGrid>
  </div>
</template>
<script>
import StackGrid from 'vue-stack-grid-component'
import {LOGOUT} from "../../store/mutation-types";

export default {
  name: 'my_feed',
  components: {
    StackGrid
  },
  data: () => ({
    events: '',
    isLoading: false,
    bell_clicked: [],
    heat_liked: [],
    loading: ''

  }),
  created() {
    this.fetchEvent()
  },
  methods: {
    fetchEvent() {
      this.$api.get('/events/myfeed')
        .then((response) => {
          console.log(response.data)
          this.events = response.data
          this.waitImg()
          this.loading = ''
        })
        .catch((error) => {
          this.loading = false
          console.log(error)
          console.log(error.response)
        })
    },
    waitImg() {
      let imageLoaded = 0;
      for (const imageSrc of this.events) {
        const img = new Image();
        img.src = imageSrc.image_path;

        img.onload = () => {
          imageLoaded++;
          if (imageLoaded === this.events.length) {
            this.isLoading = true;
          }

          console.log(imageLoaded);
        };
      }
    },
    interests(v, i) {
      this.loading = i.id
      this.$api.post('/event/' + i.id + "/interest/" + v)
        .then((response) => {
          console.log(response.data)
          this.fetchEvent()

        })
        .catch((error) => {
          console.log(error)
          console.log(error.response)
        })

    }
  },

}
</script>
<style>
.filter-svg {
  filter: invert(100%) sepia(95%) saturate(13%) hue-rotate(243deg) brightness(104%) contrast(100%);
}

.bar-icon {
  display: flex;
  justify-content: space-around;
  float: left;
  position: absolute;
  left: 0;
  bottom: 0;
  z-index: 1000;
  width: 100%;
  background-color: rgba(230, 230, 230, 0.6);
  padding: 5px;
  color: #000000;
  font-weight: bold;
  text-align: center;
  border-radius: 0 0 35px 35px;
}

.body-height {
  min-height: 100vh
}

.color {
  color: #D70039;
  text-align: center;
}

.blue {
  color: #2b40a7;
}

h6 {
  font-weight: bold;
}

.img-card {
  max-width: 200px;
  object-fit: cover;
  border-radius: 35px;
}

.container-img {
  position: relative;
}
</style>
