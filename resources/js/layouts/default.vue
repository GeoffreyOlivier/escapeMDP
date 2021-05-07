<template>
  <div class="main-layout">
    <navbar />

    <div class="container mt-4">
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
