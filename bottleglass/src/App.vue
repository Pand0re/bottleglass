<template>
  <div id="app">
    <Header></Header>
    <router-view/>
    <Footer></Footer>
  </div>
</template>

<script>
  import Header from "./components/Header";
  import Footer from "./components/Footer";
  export default {
    name: 'App',
    components: {Footer, Header},
    data: function() {
      return {
        ShoppingCart: [
          {
            name: 'Verre classique',
            desc: 'Un verre classique ',
            amount: 0,
            uprice: 4.5,
            img: './static/carousel/verres-classiques.jpeg'
          },
          {
              name: 'Verre à pieds',
              desc: 'Un verre à pieds qui convient parfaitement pour un cocktail. Réalisé avec un haut de bouteil blah blah',
              amount: 0,
              uprice: 5.5,
              img: './static/carousel/verres-pied.jpg'
          },
          {
            name: 'Bougie',
            desc: 'Une bougie réalisée à partir d\'un fond de bouteille.',
            amount: 0,
            uprice: 6.5,
            img: './static/produits/bougie1.jpg'
          },
          {
              name: 'Pack « starter »',
              desc: '2 verres classiques et un verre à vin ! Ce pack peut légèrement varier selon notre stock de verre.',
              amount: 0,
              uprice: 10,
              img: './static/produits/Pack-2VC-1VP.jpg'
          }/*,
          {
            name: 'Pot de fleurs',
            desc: 'Un pot de fleur ...',
            amount: 0,
            uprice: 10,
            img: './static/carousel/verres-pied.jpg'
          }*/
        ]
      };
    }
  }

</script>

<style>

  html, body {
    min-height: 100%;
    margin: 0;
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
  }

  button, a {
    cursor: pointer;
  }

  #app {
    font-family: "SF Pro Display","SF Pro Icons","Helvetica Neue","Helvetica",
    "Arial",sans-serif;
    margin-top: 50px;
  }

  .main-container {
    margin: 60px calc(50% - 305px) 30px calc(50% - 305px);
    max-width: 610px;
  }


  p {
    padding-left: 30px;
    text-align: justify;
    padding-right: 15px;
    line-height: 1.2;
    font-size: 1.2em;
  }

  h1 {
    padding-left: 20px;
    font-size: 3em;
    padding-bottom: 5px;
    margin-bottom: 0;
    border-bottom: 2px solid #ddd;
    font-weight: 400;
  }

  h2 {
    border-bottom: 1px solid #eee;
    font-size: 2em;
    margin-bottom: 5px;
  }

  /* Disable text selection */
  .noselect {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  @media (max-width: 750px) {
    h1 {
      font-size: 2.5em;
    }
  }

  @media (max-width: 615px) {
    .main-container {
      margin: 60px 1% 30px 1%;
      max-width: 97%;
    }

    h1 {
      font-size: 2em;
    }

    h2 {
      font-size: 1.5em;
    }

    p {
      font-size: 1em;
    }

  }


</style>
