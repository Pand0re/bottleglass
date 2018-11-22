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
            name: 'Bougie',
            desc: 'Une bougie ...',
            amount: 0,
            uprice: 6.5,
            img: './static/carousel/verres-pied.jpg'
          },
          {
            name: 'Verre à pieds',
            desc: 'Un verre à pieds qui convient parfaitement pour un cocktail. Réalisé avec un haut de bouteil blah blah',
            amount: 0,
            uprice: 7.5,
            img: './static/carousel/verres-pied.jpg'
          },
          {
            name: 'Verre classique',
            desc: 'Un verre classique ...',
            amount: 0,
            uprice: 8.95,
            img: './static/carousel/verres-classiques.jpeg'
          },
          {
            name: 'Pot de fleurs',
            desc: 'Un pot de fleur ...',
            amount: 0,
            uprice: 7.5,
            img: './static/carousel/verres-pied.jpg'
          }
        ]
      };
    }
  }

  /*
  function load(url, callback) {
        var xhr;

        if(typeof XMLHttpRequest !== 'undefined') xhr = new XMLHttpRequest();
        else {
            var versions = ["MSXML2.XmlHttp.5.0",
                            "MSXML2.XmlHttp.4.0",
                            "MSXML2.XmlHttp.3.0",
                            "MSXML2.XmlHttp.2.0",
                            "Microsoft.XmlHttp"]

             for(var i = 0, len = versions.length; i < len; i++) {
                try {
                    xhr = new ActiveXObject(versions[i]);
                    break;
                }
                catch(e){}
             } // end for
        }

        xhr.onreadystatechange = ensureReadiness;

        function ensureReadiness() {
            if(xhr.readyState < 4) {
                return;
            }

            if(xhr.status !== 200) {
                return;
            }

            // all is well
            if(xhr.readyState === 4) {
                callback(xhr);
            }
        }

        xhr.open('GET', url, true);
        xhr.send('');
    }
   */
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
