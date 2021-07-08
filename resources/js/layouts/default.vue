<template>
  <div class="main-layout">
    <navbar />

    <div class="container test mt-4">
      <child />
    </div>
    <foot/>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
import foot from '~/components/footer'
export default {
  name: 'MainLayout',

  components: {
    Navbar,
    foot
  }
}
</script>
<style>
.test{
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
.main-layout{
  min-height: 100vh;
}
/*html, body {*/
/*  height: 100%;*/
/*}*/

/*#app {*/
/*  display: flex;*/
/*  flex-direction: column;*/
/*  height: 100%;*/
/*}*/
</style>

