<template>
  <div class="container" :style="GetContainerStyle">
    <div class="title">Panier</div>

    <div class="cart">
      <template v-for="item in GetCart">
        <div class="cart-item">
          <span>{{ item.name }}</span>
          <span>x{{ item.amount }}</span>
          <span>{{ item.amount * item.uprice }} CHF</span>
        </div>
      </template>
    </div>

    <div class="total">
      Total : {{ GetTotalPrice }} CHF
    </div>

    <button class="buy">Acheter</button>

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
      },

      GetContainerStyle: function() {
        return 'height: ' + (this.IsOpen ? 'auto' : '0') + ';';
      }
    }
  }
</script>

<style scoped>

  .container {
    position: absolute;
    right: 0;
    left: calc(100% - 400px);
    top: 50px;
    max-width: 100%;
    background-color: black;
    width: 400px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
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

  .cart {
    color: white;
    padding-bottom: 15px;
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

  .buy:hover {
    background-color: white;
    color: black;
  }

</style>
