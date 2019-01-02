<template>
  <div class="container">
    &copy; 2019 Bottle Glass. {{ $t('t.miscellaneous.AllRightsReserved') }}
  </div>
</template>

<script>
  export default {
    name: "Footer"
  }
</script>

<style scoped>
  .container {
    padding-bottom: 20px;
    margin: 0;
    height: auto;
    /*background: #f3e5ab;*/
    font-size: 0.8em;
    text-align: center;
  }
</style>
