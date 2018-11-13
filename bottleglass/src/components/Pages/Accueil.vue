<template>
  <div class="main-container">
    <h1>BottleGlass</h1>
    <carousel
      :per-page="1"
      :mouse-drag="true"
      :autoplay="true"
      :navigationEnabled="false"
      :autoplayTimeout="2000"
      :loop="true"
    >

      <slide data-name="Recyclage de bouteilles">
        <div class="carousel-content">
          <span>
            Recyclage de bouteilles en verres
          </span>
        </div>
        <img src="/static/carousel/verres-pied.jpg" style="width: 100%">
      </slide>

      <slide>
        <div class="carousel-content">
          <span>
            Verres à pieds
          </span>
        </div>
        <img src="/static/carousel/verres-pied.jpg" style="width: 100%">
      </slide>

      <slide>
        <div class="carousel-content">
          <span>
            Verres classiques
          </span>
        </div>
        <img src="/static/carousel/verres-pied.jpg" style="width: 100%">
      </slide>

      <slide>
        <div class="carousel-content">
          <span>
            Pots de fleurs
          </span>
        </div>
        <img src="/static/carousel/verres-pied.jpg" style="width: 100%">
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
  .carousel-content {
    width: 100%;
    bottom: 15px;
    text-align: center;
    position: absolute;
    font-size: 2em;
    left: auto;
    color: white;
    border-radius: 3px;
  }

  .carousel-content span {
    transition: 1s;
    border: 1px solid white;
    font-weight: 100;
    padding: 3px 10px;
    background-color: #111;
    border-radius: 3px;
  }

  @media (max-width: 600px) {
    .carousel-content {
      font-size: 1em;
      bottom: 20px;
    }

  }


</style>
