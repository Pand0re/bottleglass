<template>
  <div>
    <div class="head">
      <ul class="products">
        <li><a href="#"><img src="../../assets/vectors/cocktail.svg"/>    Verres à pieds    </a></li>
        <li><a href="#"><img src="../../assets/vectors/orange-juice.svg"/>Verres classiques </a></li>
        <li><a href="#"><img src="../../assets/vectors/candle.svg"/>      Bougies           </a></li>
        <li><a href="#"><img src="../../assets/vectors/growing.svg"/>     Pots de fleurs    </a></li>
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
  }

  ul.products li:hover {
    filter: invert(35%);
  }

</style>
