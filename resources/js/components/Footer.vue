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
            <eva-icon name="facebook"></eva-icon>
            <eva-icon name="twitter"></eva-icon>
            <img src="../../images/V1.png" alt="logo" class="img-foot">
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
  background-color: #666363;
  height: 130px;
  width: 100%;
}
.link-footer{
  margin-top: 30px;
  display: flex;
  justify-content: space-between;
}
.icon{
  text-align: end;
}
</style>
