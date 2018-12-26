<template>
  <div class="main-container">
    <h1>BottleGlass</h1>

    <br/>
    <p>
      {{ $t('t.home.sentence1') }}
    </p>

    <carousel
      :per-page="1"
      :mouse-drag="true"
      :autoplay="true"
      :navigationEnabled="false"
      :autoplayTimeout="3200"
      :loop="true"
    >

      <slide data-name="Recyclage de bouteilles">
        <div class="carousel-content">
          <span>
            {{ $t('t.home.carousel') }}
          </span>
        </div>
        <img src="/static/produits/Pack-2VC-1VP.jpg" style="width: 100%">
      </slide>

      <slide>
        <div class="carousel-content">
          <span>
            {{ $t('t.products.Goblets') }}
          </span>
        </div>
        <img src="/static/carousel/verres-pied.jpg" style="width: 100%">
      </slide>

      <slide>
        <div class="carousel-content">
          <span>
            {{ $t('t.products.ClassicGlasses') }}
          </span>
        </div>
        <img src="/static/carousel/verres-classiques.jpeg" style="width: 100%">
      </slide>

      <slide>
        <div class="carousel-content">
          <span>
            {{ $t('t.products.Candles') }}
          </span>
        </div>
        <img src="/static/produits/bougie1.jpg" style="width: 100%">
      </slide>

    </carousel>

    <p>
      {{ $t('t.home.sentence2') }}
    </p>

    <br/>
    <br/>

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
    display: block;
    bottom: 0;
    text-align: center;
    position: absolute;
    font-size: 2em;
    left: auto;
    color: white;
    height: 50px;
  }

  .carousel-content span {
    width: 100%;
    height: 100%;
    display: block;
    transition: 1s;
    line-height: 50px;
    font-weight: 100;
    font-size: 1.5em;
    background-color: rgba(0,0,0,0.7);
  }

  @media (max-width: 600px) {
    .carousel-content {
      font-size: 1em;
      bottom: 0;
    }

  }


</style>
