<template>
  <div class="main-container">

    <div class="head">
      <h1 class="caption">BottleGlass</h1>
      <p>
        {{ $t('t.home.carousel') }}
      </p>
    </div>

    <div class="block-container">
      <div class="block">
        <h2>{{ $t('t.home.title1') }}</h2>
        <p>
          {{ $t('t.home.sentence1') }}
        </p>

        <carousel :data="GetCarouselData"></carousel>

      </div>

      <div class="block">
        <h2>{{ $t('t.home.title2') }}</h2>
        <p>
          {{ $t('t.home.sentence2') }}

          <router-link :to="{name:'Acheter'}" class="hover-effect">
            &rsaquo;
          </router-link>
        </p>
        <img class="img-clickable img-buy" src="../../assets/pics/shipping.jpg">
      </div>
    </div>

    <div class="block-container">
      <div class="block">
        <h2>{{ $t('t.home.title3') }}</h2>
        <p>
          {{ $t('t.home.sentence3') }}
        </p>

        <iframe src="https://www.youtube.com/embed/dgmPmzgKNKU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

      </div>

      <div class="block">
        <h2>{{ $t('t.home.title4') }}</h2>
        <p>
          {{ $t('t.home.sentence4') }}
        </p>
        <img class="img-clickable img-buy" src="https://www.divtec.ch/wp-content/uploads/2015/11/divtec-batiement-d-est.jpg">
      </div>
    </div>

    <br/>
    <br/>

  </div>
</template>

<script>
  export default {
    name: "Accueil",
    data: function() {
      return {
        carousel: [
          {
            text:'Verre classique',
            img:'https://bottleglass.ch/static/produits/IMG_9692.JPG'
          },
          {
            text:'Verre à pied',
            img:'https://bottleglass.ch/static/produits/IMG_9699.JPG'
          },
          {
            text:'Verre classique Martini',
            img:'https://bottleglass.ch/static/produits/IMG_9695.JPG'
          },
          {
            text:'Verre classique',
            img:'https://bottleglass.ch/static/produits/IMG_9697.JPG'
          },
          {
            text:'Verre à pied',
            img:'https://bottleglass.ch/static/produits/IMG_9721.JPG'
          }
        ],
        carouselStyle: 'text-align:center;position:absolute;bottom:25px;text-align:center;width:100%;color:white;font-size:1.4em;',
        innerCarouselStyle: 'background-color:rgba(0,0,0,0.45);padding:5px 15px;border-radius:5px;'
      }
    },
    computed: {
      GetCarouselData: function() {
        let a = [];
        for (let item of this.carousel) {
          a.push(
            `<div style="${this.carouselStyle}"><span style="${this.innerCarouselStyle}">${this.$t(item.text)}</span></div><img src="${item.img}"/>`
          );
        }
        return a;
      }
    }
  }
</script>



<style scoped>

  .about-link {
    text-decoration: none;
    color: #444;
  }

  .block h2 {
    margin-top: 0;
  }

  img, iframe {
    max-width: 100%;
  }

  p {
    margin: 0;
    padding: 0;
  }

  .img-buy, iframe {
    width: 100%;
  }

  iframe {
    height: 70%;
  }

  .block-container {
    display: flex;
    margin-left: calc(20% - 120px);
  }

  .block p .hover-effect {
    font-size: 1.2em;
    padding-left: 5px;
    text-decoration: none;
    opacity: 0;
    transition: 0.3s;
  }

  .block:hover p .hover-effect {
    opacity: 1;
    font-weight: 600;
    font-size: 1.2em;
  }

  .block {
    background-color: #eee;
    padding: 30px;
    border-radius: 5px;
    width: 30%;
    margin: 2% 5%;
    display: inline-block;
  }

  .block p {
    margin-bottom: 20px;
  }

  .head {
    background-size: 100%;
    background: url("https://bottleglass.ch/static/carousel/verres-classiques.jpeg") fixed 0 135%;
    padding: 10px;
    font-size: 3em;
    top: -10px;
    position: relative;
    color: white;
    height:500px;
  }

  .caption {
    text-align: center;
    border: 0;
  }

  .main-container {
    width: 100%;
    margin: 0;
    max-width: 100%;
  }

  .img-clickable {
    cursor: pointer;
  }


  h1.caption {
    border-bottom: 6px solid black;
    width: 750px;
    padding-bottom: 0;
    margin-left: 50%;
    left: -375px;
    position: relative;
  }

  .head p {
    position: relative;
    width: 700px;
    color: #bbb;
    background-color: rgba(0,0,0,0.6);
    padding: 20px;
    margin-top: 10px;
    border-radius: 5px;
    left: -370px;
    font-size: 1em;
    margin-left: 50%;
  }

  @media (max-width: 1300px) {

    .head {
      background-size: 100%;
      background: url("https://bottleglass.ch/static/carousel/verres-classiques.jpeg") fixed 50% 135%;
    }

    .block {
      padding: 30px;
      border-radius: 5px;
      width: 40%;
      margin: 2% 3%;
    }

    .block-container {
      margin-left: calc(10% - 120px);
    }
  }

  @media (max-width: 1000px) {
    .block {
      padding: 30px;
      border-radius: 5px;
      width: 40%;
      margin: 2% 1%;
    }

    .block-container {
      margin-left: calc(15% - 120px);
    }
  }

  @media (max-width: 900px) {
    .block {
      padding: 30px;
      border-radius: 5px;
      width: calc(100% - 64px - 5%);
      margin: 5% 1%;
      max-width: 100%;
    }

    .block-container {
      display: block;
      margin-left: 5%;
    }
  }

  @media (max-width: 850px) {
    .head {
      padding: 10px;
      font-size: 2em;
      top: -10px;
      position: relative;
      color: white;
      height:400px;
    }

    .head p {
      width: 500px;
      padding: 20px;
      margin-top: 10px;
      border-radius: 5px;
      left: -250px;
      font-size: 1em;
    }

    h1.caption {
      width: 520px;
      padding-bottom: 0;
      margin-left: 50%;
      left: -250px;
    }

  }
  @media (max-width: 650px) {
    .head {
      padding: 10px;
      font-size: 1.5em;
      top: -10px;
      position: relative;
      color: white;
      height:300px;
    }

    .head p {
      width: 400px;
      padding: 20px;
      margin-top: 10px;
      border-radius: 5px;
      left: -200px;
      font-size: 1em;
    }

    h1.caption {
      width: 420px;
      padding-bottom: 0;
      margin-left: 50%;
      left: -200px;
    }


    .head {
      background: url("https://bottleglass.ch/static/carousel/verres-classiques.jpeg") fixed 50% 0;
      background-size: 100%;
    }

  }
  @media (max-width: 550px) {
    .head {
      padding: 10px;
      font-size: 1.5em;
      top: -10px;
      position: relative;
      color: white;
      height:200px;
      margin: 0;
    }

    .head p {
      width: 400px;
      padding: 20px;
      margin-top: 10px;
      border-radius: 5px;
      left: -215px;
      font-size: 1em;
    }

    h1.caption {
      width: 420px;
      padding-bottom: 0;
      margin-left: 50%;
      left: -215px;
    }

  }
  @media (max-width: 479px) {
    .head {
      padding: 10px;
      font-size: 1.5em;
      top: -10px;
      position: relative;
      color: white;
      height:200px;
      margin: 0;
    }

    .head p {
      width: 350px;
      padding: 20px;
      margin-top: 10px;
      border-radius: 5px;
      left: -195px;
      max-width: 100%;
    }

    h1.caption {
      width: 370px;
      padding-bottom: 0;
      margin-left: 50%;
      left: -195px;
      max-width: 100%;
    }


    .block {
      padding: 30px;
      border-radius: 5px;
      width: calc(100% - 64px - 2%);
      margin: 2% 0;
      max-width: 100%;
    }

    .block-container {
      display: block;
      margin-left: 2%;
    }

  }


</style>
