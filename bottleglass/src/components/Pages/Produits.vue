<template>
  <div class="container">
    <div class="head">
      <ul class="products">
        <li><a href="#i1"><img src="../../assets/vectors/cocktail.svg"/>    <span>Verres à pieds    </span></a></li>
        <li><a href="#i2"><img src="../../assets/vectors/orange-juice.svg"/><span>Verres classiques </span></a></li>
        <li><a href="#i0"><img src="../../assets/vectors/candle.svg"/>      <span>Bougies           </span></a></li>
        <li><a href="#i3"><img src="../../assets/vectors/package.svg"/>     <span>Packs             </span></a></li>
      </ul>
    </div>


    <Product v-for="(item, key) in $parent.ShoppingCart"
      :name="item.nom_pro"
      :description="item.desc_pro"
      :price="item.prix_pro"
      :img="item.img_pro"
      :index="key"
      :key="key"
    ></Product>

    <div ref="alert" class="alert"></div>
  </div>
</template>

<script>
  import Product from "../custom/Product";
  export default {
    name: "Produits",
    components: {Product},
    methods: {
      ShowAlert: function(itemName) {
        this.$refs.alert.innerHTML = "Le produit &laquo; " + itemName + " &raquo; a été ajouté au panier.";
        this.$refs.alert.classList += " show";

        let Self = this;

        setTimeout(function() {
          Self.$refs.alert.classList.remove('show');
          Self.$refs.alert.classList += " hide";

          setTimeout(function() {
            Self.$refs.alert.classList.remove('hide');
          }, 500);
        }, 2500);

      }
    }
  }
</script>

<style scoped>

  .container {
    padding-top: 80px;
  }

  ul.products li {
    list-style: none;
    display: inline-block;
    text-align: center;
    min-width: 180px;
    transition: 0.3s;
  }

  ul.products {
    padding: 15px 30%;
    margin: 0;
    background-color: #F3E5DB;
    color: black;
    display: flex;
    justify-content: space-around;
  }

  .head {
    width: 100%;
    display: block;
    position: fixed;
    top: 40px;
    z-index: 99;
  }

  ul.products li a {
    text-align: center;
    position: relative;
  }

  ul.products li a img {
    max-width: 30px;
    vertical-align: bottom;
    margin-left: 5px;
  }

  ul.products li a {
    color: black;
    text-decoration: none;
    min-width: 130px;
  }

  ul.products li:hover {
    filter: invert(40%);
  }



  .alert {
    position: fixed;
    right: 10px;
    bottom: -100px;
    z-index: 99;
    padding: 20px;
    font-size: 1.3em;
    border-radius: 5px;
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
  }

  .alert.show {
    animation: alert-appear 0.5s ease-in-out;
    bottom: 10px;
  }

  .alert.hide {
    animation: alert-disappear 0.5s ease-in-out;
    bottom: -100px;
  }

  @keyframes alert-appear {
    0% {bottom: -100px;}
    100% {bottom: 10px;}
  }

  @keyframes alert-disappear {
    0% {bottom:   10px;}
    100% {bottom: -100px;}
  }


  @media (max-width: 730px) {
    ul.products li {
      display: inline-block;
      width: 45%;
      margin-bottom: 5px;
    }

    ul.products {
      padding: 15px;
      display: block;
    }
  }


  @media (max-width: 450px) {

    .alert {
      width: 90%;
      bottom: -100px;
      right: 0;
    }

    .alert.show {
      animation: alert-appear-sm 0.5s ease-in-out;
      bottom: 0;
    }

    .alert.hide {
      animation: alert-disappear-sm 0.5s ease-in-out;
      bottom: -100px;
    }

    @keyframes alert-appear-sm {
      0% {bottom: -100px;}
      100% {bottom:  0;}
    }

    @keyframes alert-disappear-sm {
      0% {bottom:      0;}
      100% {bottom: -100px;}
    }

  }

  @media (max-width: 399px) {
    ul.products li a {
      min-width: 50px;
    }

    ul.products li {
      min-width: 50px;
      width: 24%;
    }

    ul.products li a span {
      display: none;
    }
  }

</style>
