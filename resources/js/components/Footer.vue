<template>
  <div class="container-fluid footer mt-5">
    <b-row>
      <b-col class="link-footer">
          <b-col class="ml-5">
            <p>Mentions légales . Condition générales</p>
            <p>Politique de confidentialitée</p>
          </b-col>
          <b-col>
            <p>Nous contacter</p>
          </b-col>
          <b-col class="icon mr-5">
            <svg class="filter-svg-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="twitter"><polyline points="0 0 24 0 24 24 0 24" opacity="0"/><path d="M8.08 20A11.07 11.07 0 0 0 19.52 9 8.09 8.09 0 0 0 21 6.16a.44.44 0 0 0-.62-.51 1.88 1.88 0 0 1-2.16-.38 3.89 3.89 0 0 0-5.58-.17A4.13 4.13 0 0 0 11.49 9C8.14 9.2 5.84 7.61 4 5.43a.43.43 0 0 0-.75.24 9.68 9.68 0 0 0 4.6 10.05A6.73 6.73 0 0 1 3.38 18a.45.45 0 0 0-.14.84A11 11 0 0 0 8.08 20"/></g></g></svg>
            <svg class="filter-svg-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g data-name="Layer 2"><g data-name="facebook"><rect  transform="rotate(180 12 12)" opacity="0"/><path d="M17 3.5a.5.5 0 0 0-.5-.5H14a4.77 4.77 0 0 0-5 4.5v2.7H6.5a.5.5 0 0 0-.5.5v2.6a.5.5 0 0 0 .5.5H9v6.7a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-6.7h2.62a.5.5 0 0 0 .49-.37l.72-2.6a.5.5 0 0 0-.48-.63H13V7.5a1 1 0 0 1 1-.9h2.5a.5.5 0 0 0 .5-.5z"/></g></g></svg>
            <img src="../../images/logo-white.png" alt="logo" class="img-foot">
          </b-col >
      </b-col>
    </b-row>
  </div>
</template>
<script>
export default {
  name: 'foot'
}
</script>

<style>
.img-foot{
  height: 50px;
  width: 50px;
}
.footer {
  background-color: #111D5E;
  height: 130px;
  width: 100%;

}
.link-footer{
  margin-top: 30px;
  display: flex;
  justify-content: space-between;
  color: white;
}
.icon{
  text-align: end;
}
.filter-svg-white {
  filter: invert(100%) sepia(95%) saturate(13%) hue-rotate(243deg) brightness(104%) contrast(100%);
}
</style>
