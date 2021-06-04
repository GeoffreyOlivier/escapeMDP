<template>
  <div>
    <h2 class="firstname">{{ user.firstname }}</h2>
    <h3 class="lastname">{{ user.lastname }}</h3>
    <div class="header">
      <div>
        <img class="one  " src="../../../images/4.jpg" alt="">
      </div>
      <div>
        <img class="two  " src="../../../images/1.jpg" alt="">
      </div>
      <div>
        <img class="three  " src="../../../images/2.jpg" alt="">
      </div>
      <div>
        <img class="four  " src="../../../images/3.jpg" alt="">
      </div>
    </div>
    <div class="cta-edit-profile">Modifier mon compte</div>
    <div class="body">
      <div class="row">
        <b-col class="prefer">
          <div class="prefer-column">
            <eva-icon class="eva-icon" width="40px" height="40px" fill="#D70039" name="pin-outline"></eva-icon>
            <p>Rennes</p>
            <p>Bruz</p>
            <p>Extérieur</p>
            <p>- de 30 km</p>

          </div>
          <div class="prefer-column">
            <eva-icon class="eva-icon" width="40px" height="40px" fill="#D70039" name="music"></eva-icon>
            <p>Techno</p>
            <p>Pop</p>
            <p>House</p>
          </div>
          <div class="prefer-column">
            <eva-icon class="eva-icon" width="40px" height="40px" fill="#D70039" name="speaker"></eva-icon>
            <p>Musée</p>
            <p>Exposition</p>
          </div>
          <div class="prefer-column">
            <eva-icon class="eva-icon" width="40px" height="40px" fill="#D70039" name="layers"></eva-icon>
            <p>Basket</p>
            <p>Volley</p>
          </div>
        </b-col>
        <div class="vertical"></div>
        <b-col>
          <h2>Mes comptes</h2>

        </b-col>
      </div>
    </div>
  </div>
</template>

<style scoped>
h2{
  /*padding-top: 35px;*/
  color: #111D5E !important;
  font-family: Gobold_Extra2, serif;
}
.vertical {
  border-left: 2px solid #111D5E;
  height: 300px;
}

.prefer-column {
  display: flex;
  flex-direction: column;
  align-content: center;
}

p {
  color: #000000 !important;
  font-family: Gobold_Extra2, serif;
  padding-bottom: 10px;
  display: flex;
  align-content: center;
  justify-content: center;
}

.eva-icon {
  padding-bottom: 30px;
  display: flex;
  align-content: center;
  justify-content: center;

}

.cta-edit-profile {
  text-align: right;
  padding-top: 100px;
}

.firstname {
  position: absolute;
  color: #111D5E !important;
  font-weight: bolder;
  font-family: Gobold_Extra2, serif;
  line-height: 60px;
}

.lastname {
  position: absolute;
  padding-top: 35px;
  color: #111D5E !important;
  font-family: Gobold_Extra2, serif;
  line-height: 60px;
}

.header {
  display: grid;
  width: 100%;
  grid-template-columns: repeat(4, 10fr);
}

img {
  border-radius: 50%;
  object-fit: cover;
}

.one {
  width: 350px;
  height: 350px;
  transform: translate(7px, 31%);
  z-index: 15;
  position: relative;
}

.two {
  width: 300px;
  height: 300px;
  transform: translate(-53px, 0%);
  z-index: 5;
  position: relative;
}

.three {
  width: 280px;
  height: 280px;
  transform: translate(-126px, 60%);
}

.four {
  width: 400px;
  height: 400px;
  transform: translate(-223px, 0%);
}

.prefer {
  display: grid;
  width: 100%;
  grid-template-columns: repeat(4, 10fr);
}

@media screen and (max-width: 640px) {
  .header {
    display: grid;
    width: 100%;
    grid-template-columns: repeat(1, 1fr);
    grid-template-rows: repeat(4, 1fr);
  }

  .one {
    width: 250px;
    height: 250px;
    transform: translate(-66px, 40%);
    z-index: 15;
    position: relative;
  }

  .two {
    width: 222px;
    height: 222px;
    transform: translate(122px, -34%);
    z-index: 17;
    position: relative;
  }

  .three {
    width: 200px;
    height: 200px;
    transform: translate(40px, -65%);
    z-index: 20;
    position: relative;
  }

  .four {
    width: 250px;
    height: 250px;
    transform: translate(147px, -99%);
  }
}
</style>

<script>
import Form from "vform";
import {mapGetters} from "vuex";

export default {
  middleware: 'auth',

  metaInfo() {
    return {title: this.$t('reset_password')}
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  computed: mapGetters({
    user: 'auth/user'

  }),
  methods: {
    async send() {
      const {data} = await this.form.post('/api/password/email')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
