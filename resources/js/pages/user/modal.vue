<template>
  <div>
    <div class="md:w-1/2 center bg-teal-light min-h-screen overflow-scroll">
      <h1 class="text-grey-darkest my-4">Vue Fuse Demo</h1>
      <b-row>
        <b-col>
          <div v-for="sub_style_selected in sub_style_selecteds" :keys:="sub_style_selecteds.item">
            <div class="selected"></div>
            <b-button squared variant="outline-primary" @click="remove_sub_style(sub_style_selected)">
              {{ sub_style_selected.item.sub_style_name }} X
            </b-button>
          </div>
        </b-col>
        <b-col>
          <div v-for="style_selected in style_selecteds" :keys:="style_selecteds.id">
            <div class="selected"></div>
            <b-button squared variant="outline-secondary" @click="remove_style(style_selected)">
              {{ style_selected }} X
            </b-button>
          </div>
        </b-col>
      </b-row>


<!--      <div id="autocomplete" class="autocomplete">-->
<!--        <input class="autocomplete-input"-->
<!--               placeholder="Search for a country"-->
<!--               aria-label="Search for a country"-->
<!--        >-->
<!--        <ul class="autocomplete-result-list"></ul>-->
<!--        <ul id="no-results" class="autocomplete-result-list" visible="false">-->
<!--          <li class="autocomplete-result">-->
<!--            No results found-->
<!--          </li>-->
<!--        </ul>-->
<!--      </div>-->



    </div>
    </div>
</template>

<script>
import VueFuse from '../components/fuse'

export default {
  name: 'App',
  components: {
    VueFuse,
  },
  data() {
    return {
      advanced: false,
      search: '',
      includeScore: false,
      results: [],
      styles: [],
      style_selecteds: [],
      sub_style_selecteds: [],
      input_search: false,
      input: ''
    }
  },
  computed: {
    options() {
      return {
        keys: [
          'sub_style_name',
          'style_name'
        ],
        includeScore: this.includeScore,
        threshold: 0.4
      }
    },
  },
  created() {
    this.fetchStyle()
    console.log(this.search)
  },
  methods: {
    add(v, i) {
      let tmp
      if (this.style_selecteds.includes(v.item.style_name)) {
      } else {
        this.style_selecteds.push(v.item.style_name)
      }
      if (this.sub_style_selecteds.includes(v)) {
        let style_selecteds_trash = this.sub_style_selecteds.indexOf(v)
        this.sub_style_selecteds.splice(style_selecteds_trash, 1)
      } else {
        this.sub_style_selecteds.push(v)
      }
    },
    remove_sub_style(v) {
      const nb_of_style = this.sub_style_selecteds.filter(item => item.item.style_name === v.item.style_name).length;
      if (nb_of_style < 2) {
        let tmp = v.item.style_name
        let style_selecteds_trash = this.style_selecteds.indexOf(tmp)
        this.style_selecteds.splice(style_selecteds_trash, 1)
      }
      let sub_tyle_selecteds_trash = this.sub_style_selecteds.indexOf(v)
      this.sub_style_selecteds.splice(sub_tyle_selecteds_trash, 1)
    },
    remove_style(v) {
      let style_selecteds_trash = this.style_selecteds.indexOf(v)
      this.style_selecteds.splice(style_selecteds_trash, 1)
      let tabsubstyle = this.sub_style_selecteds.filter(item => item.item.style_name === v)
      for (var i = 0; i < tabsubstyle.length; i++) {
        let sub_tyle_selecteds_trash = this.sub_style_selecteds.indexOf(tabsubstyle[i])
        this.sub_style_selecteds.splice(sub_tyle_selecteds_trash, 1)
      }
    },
    handleResults(r) {
      this.results = r
    },
    fetchStyle() {
      this.$api.get('/style')
        .then((response) => {
          console.log(response.data)
          this.styles = response.data
        })
        .catch((error) => {
          this.loading = false
          console.log(error)
          console.log(error.response)
        })
    }
  },
  watch: {
    search(value) {
      console.log("watch")
      console.log(this.input_search)
      this.input_search = !(value = '');
    }
  },
}
</script>

<style scoped>
.style {
  color: #102a7a;
  font-size: small;
}

ul {
  height: 250px;
  overflow: auto;
  list-style-type: none;
}


.active {
  background-color: #1c7430;
}

.active {
  background-color: #0f6674;
  color: #002752;
}

.center {
  margin: auto;
  text-align: center;
}

svg {
  position: sticky;
  top: 15px;
  left: 15px;
}

/*.autocomplete-input {*/
/*  position: relative;*/
/*  top: 18px;*/
/*  left: 70px;*/
/*}*/
/*.autocomplete-result-list{*/
/*  position: absolute;*/
/*}*/

</style>
