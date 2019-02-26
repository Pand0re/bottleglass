<template>
  <div class="container">
    <div class="anchor" :id="type"></div>
    <div class="wrapper" >
      <img :src="img" alt="Produit"/>
    </div>
    <div class="wrapper">
      <h2>
        {{ $t(name) }}
        <span class="stock rupture" v-if="stock <= 0">
          {{ $t('t.products.SoldOut') }}
        </span>
        <span class="stock" v-else>
          {{ $t('t.products.Available') }}
        </span>
      </h2>
      <p>
        {{ $t(description) }}
      </p>
    </div>
    <div class="cost">
        <span>
          {{ parseFloat(price).toFixed(2) }} CHF / {{ $t('t.products.unit') }}
        </span>
      <button :style="GetButtonStyle()" :disabled="stock <= 0" @click="AddItemToCart">
        {{ $t('t.products.AddToCart') }}
      </button>
    </div>
  </div>
</template>

<script>
  export default {
    name: "Product",
    props: [
      'name',
      'description',
      'img',
      'price',
      'index',
      'stock',
      'type'
    ],

    methods: {
      AddItemToCart: function() {
        this.$parent.$parent.ShoppingCart[this.index].amount++;
        this.$parent.ShowAlert(this.name);
      },

      /**
       * @returns {string} The button's style
       * @constructor
       */
      GetButtonStyle: function() {
        return this.stock <= 0 ? 'cursor: not-allowed!important;' : '';
      }
    }

  }
</script>

<style scoped>

  .stock {
    padding: 5px 8px;
    border: 1px solid black;
    font-size: 0.5em;
    border-radius: 5px;
    vertical-align: middle;
    background-color: #ddffdd;
    text-align: right;
    float: right;
  }

  .rupture {
    background-color: #ffdddd;
  }

  .container {
    background-color: #f5f5f6;
    margin: 100px 10% 10% 10%;
    padding: 50px 60px;
    border-radius: 5px;
    position: relative;
    height: 450px;
    z-index: 1;
  }

  .anchor {
    position: relative;
    top: -180px;
    height: 0;
  }

  img {
    width: 600px;
    border-radius: 5px;
  }

  .wrapper:nth-child(3) {
    position: absolute;
    left: 710px;
    top: 20px;
  }

  h2 {
    border-bottom: 1px solid #777;
    width: 100%;
  }

  p {
    width: 80%;
  }

  .cost {
    position: absolute;
    bottom: 50px;
    right: 50px;

  }

  .cost span {
    padding: 10px;
    border-radius: 5px;
    background-color: white;
    font-size: 1.1em;
  }

  .cost button {
    padding: 5px 10px;
    border: 2px solid black;
    border-radius: 3px;
    margin-left: 40px;
    font-size: 1.3em;
    transition: 0.41s;
    position: relative;
    z-index: 2;
  }

  .cost button:not(:disabled):hover {
    color: white;
  }

  .cost button:not(:disabled)::before,
  .cost button:not(:disabled):after {
    content: '';
    height: 100%;
    background-color: black;
    width: 0;
    display: block;
    position: absolute;
    top: 0;
    transition: 0.4s ease-in-out;
    left: 50%;
    z-index: -1;
  }

  .cost button:hover::after {
    width: 100%;
    left: 0;
    z-index: -1;
  }

  .cost button::before {
    background-color: white;
    width: 100%;
    left: 0;
  }

  .cost button:hover::before {
    z-index: -2;
  }

  .stock {
    float: right;
  }

  .wrapper {
    width: calc(60% - 300px);
    max-width: 740px;
  }

  /***********************************************************************
   * Responsive
   ***********************************************************************/

  @media (max-width: 1400px) {
    .cost span,
    .cost button {
      text-align: center;
      display: block;
      width: 100%;
      margin: 20px 50px 0 0
    }

    .cost span {
      width: 91%;
    }

    .container {
      margin: 50px 10% 10% 10%;
    }

  }

  @media (max-width: 1300px) {
    .container {
      margin: 50px 5%;
    }

    .wrapper {
      width: 30%;
    }
  }

  @media (max-width: 1150px) {
    .container {
      margin: 30px 2%;
    }
  }

  @media (max-width: 1100px) {
    .container {
      margin: 30px 1%;
    }

    img {
      width: 500px;
      margin-top: 50px;
    }

    div.wrapper:nth-child(3) {
      width: 40%;
      left: 600px;
    }
  }

  @media (max-width: 1100px) {
    .container {
      margin: 40px 10% 60px 10%;
      height: 700px;
      width: 60%;
    }

    img {
      position: absolute;
      top: 200px;
      left: calc(50% - 250px);
    }

    div.wrapper:nth-child(3) {
      width: 70%;
      left: calc(50% - 250px);
    }
  }

  @media (max-width: 700px) {
    .container {
      margin: 50px 2% 60px 2%;
      height: 700px;
      width: 80%;
    }

  }

  @media (max-width: 600px) {
    .container {
      margin: 70px 0 60px 5px;
      height: 800px;
      width: calc( 97% - 5px );

      padding: 0;
    }

    div.wrapper:nth-child(2) {
      left: 10px;
      width: 98%;
    }

    div.wrapper:nth-child(3) {
      padding: 20px;
      width: 98%;
      left: 5%;
    }

    img {
      top: 150px;
      width: 95%;
      left: 0;
    }

    .cost {
      left: 15%;
      width: 70%;
    }

  }

  @media (max-width: 400px) {
    .container {
      margin: 0 0 50px 5px;
      height: 670px;
      width: calc(100% - 5px);

      padding: 0;
    }

    div.wrapper:nth-child(3) {
      width: calc(100% - 50px);
      left: 0;
      padding-top: 0;
      margin: 0;
    }

    div.wrapper:nth-child(2) {
      padding: 5px;
      width: calc(90% - 10px);
    }

    img {
      width: 99%;
    }

    .anchor {
      top: -130px;
    }

  }

</style>
