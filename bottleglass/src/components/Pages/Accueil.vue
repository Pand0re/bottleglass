<template>
  <div class="main-container">
    <h1>BottleGlass</h1>
    <p>

    </p>

    <carousel :per-page="1" :navigate-to="someLocalProperty" mouse-drag="false" :autoplay="true" :navigationEnabled="true">
      <slide>
        Slide 1 Content
        <img src="/static/carousel/verres-pied.jpg" style="width: 100%">
      </slide>
      <slide>
        Slide 2 Content
      </slide>
    </carousel>
  </div>
</template>

<script>
  export default {
    name: "Accueil"
  }
</script>


<style scoped>

</style>
