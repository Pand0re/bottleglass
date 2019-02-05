<template>
  <div>
    <div v-for=""></div>
  </div>
</template>

<script>
  export default {
    name: "TranslationManager",
    mounted: function() {
      this.$ajax('./static/lang/fr.json', 'GET', '',
      function(xhr) {
        console.log(JSON.parse(xhr.response));
      });
    }
  }
</script>

<style scoped>

</style>
