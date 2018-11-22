<template>
  <div class="overlay" @click="HideCart">
    <div ref="container" class="container" @click="PreventClick">
      <div class="title">Panier</div>

      <div class="cart">
        <template v-for="item in GetCart">
          <div class="cart-item">
            <span>{{ item.name }}</span>
            <span>x{{ item.amount }}</span>
            <span>{{ parseFloat(item.amount * item.uprice).toFixed(2) }} CHF</span>
          </div>
        </template>
      </div>

      <div class="total">
        <template v-if="GetTotalPrice <= 0">
          Le panier est vide
        </template>
        <template v-else>
          Total : {{ parseFloat(GetTotalPrice).toFixed(2) }} CHF
        </template>
      </div>

      <div class="purchase">
        <router-link :to="{name: 'Acheter'}" class="buy" :disabled="GetTotalPrice <= 0">Acheter</router-link>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    name: "Cart",

    data: function() {
      return {
        IsOpen: false
      }
    },

    computed: {
      GetCart: function() {
        let Items = [];

        for (let item of this.$parent.$parent.ShoppingCart) {
          if (item.amount > 0) {
            Items.push(item);
          }
        }

        return Items;
      },

      GetTotalPrice: function() {
        let Total = 0;

        for (let item of this.GetCart) {
          Total += item.amount * item.uprice;
        }

        return Total;
      }
    },

    methods: {
      PreventClick: function(event) {
        event.preventDefault();
        return false;
      },

      HideCart: function() {

        this.$refs.container.classList += " close";
        this.$refs.container.parentNode.classList += " close-overlay";

        let Self = this;

        setTimeout(function() {
          Self.$parent.IsCartOpen = false;
        }, 500);
      }
    }
  }
</script>

<style scoped>

  .overlay {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1;
    animation: open-cart-overlay 0.5s ease-in-out;
    transition: 0.5s;
  }

  .container {
    overflow: hidden;
    position: absolute;
    left: calc(60% - 100px);
    top: 40px;
    max-width: 100%;
    background-color: black;
    width: 400px;
    border-radius: 5px;
    animation: open-cart 0.5s ease-in-out;
    z-index: 1;
    transition: 0.5s;
    max-height: 400px;
  }

  .total {
    text-align: right;
    padding-right: 15px;
    margin-bottom: 15px;
    color: white;
  }

  .title {
    color: white;
    margin: 20px 20px 10px 20px;
    font-size: 1.4em;
    border-bottom: 2px solid white;
  }

  .purchase {
    height: 50px;
  }

  .cart {
    color: white;
    padding-bottom: 15px;
  }

  .close {
    max-height: 0;
    transition: 0.3s;
  }

  .close-overlay {
    background-color: rgba(0, 0, 0, 0);
  }

  @keyframes open-cart {
    0% {
      max-height: 0;
    }

    100% {
      max-height: 400px;
    }
  }

  @keyframes open-cart-overlay {
    0% {
      background-color: rgba(0, 0, 0, 0);
    }

    100% {
      background-color: rgba(0, 0, 0, 0.7);
    }
  }

  .cart-item {
    margin-left: 25px;
  }

  .cart-item span:nth-child(1) {
    width: 50%;
    display: inline-block;
  }

  .cart-item span:nth-child(2) {
    width: 20%;
    display: inline-block;
  }

  .buy {
    border: 1px solid white;
    background-color: black;
    color: white;
    font-size: 1.5em;
    border-radius: 5px;
    padding: 5px 45px;
    margin-left: calc(50% - 87px);
    margin-bottom: 20px;
    transition: 0.4s;
  }

  .buy:enabled:hover {
    background-color: white;
    color: black;
  }

  .buy:disabled {
    background-color: #666;
    cursor: not-allowed;
  }

  a {
    text-decoration: none;
  }

  @media (max-width: 770px) {
    .container {
      right: 0;
      left: unset;
    }
  }

</style>
