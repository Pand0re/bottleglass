<template>
  <div>
    <div class="head">
      <ul class="products">
        <li><a href="#"><img src="../../assets/vectors/cocktail.svg"/>    <span>Verres à pieds    </span></a></li>
        <li><a href="#"><img src="../../assets/vectors/orange-juice.svg"/><span>Verres classiques </span></a></li>
        <li><a href="#"><img src="../../assets/vectors/candle.svg"/>      <span>Bougies           </span></a></li>
        <li><a href="#"><img src="../../assets/vectors/growing.svg"/>     <span>Pots de fleurs    </span></a></li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Produits"
  }
</script>

<style scoped>
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
