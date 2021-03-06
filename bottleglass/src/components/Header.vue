<template>
  <div class="container">
    <ul class="noselect">
      <li :class="GetNavigationClass('Accueil')">
        <router-link :to="{name:'Accueil'}">
          {{ $t('t.header.Home') }}
        </router-link>
      </li>
      <li :class="GetNavigationClass('Produits')">
        <router-link :to="{name:'Produits'}">
          {{ $t('t.header.Products') }}
        </router-link>
      </li>
      <li :class="GetNavigationClass('Acheter')">
        <router-link :to="{name:'Acheter'}">
          {{ $t('t.header.Buy') }}
        </router-link>
      </li>
      <li :class="GetNavigationClass('Apropos')">
        <router-link :to="{name:'Apropos'}">
          {{ $t('t.header.About') }}
        </router-link>
      </li>
      <li title="Panier" v-on:click="ToggleCart">
        <img src="../assets/vectors/cart.svg"/>
      </li>
    </ul>
    <div ref="cart">
      <Cart v-if="IsCartOpen"></Cart>
    </div>
  </div>
</template>

<script>
  import Cart from "./custom/Cart";
  export default {
    name: "Header",
    components: {Cart},
    /**
     * Component's data
     **/
    data: function() {
      return {
        // The current route
        // We use this to allow Vue.js properties auto update
        // instead of using $route
        currentRoute: '',

        IsCartOpen: false
      }
    },


    /**
     * Component's methods
     **/
    methods: {
      /**
       * Get the navigation class according to the current route
       * @param RouteName The current route's name
       * @returns {string} The navigation's class
       */
      GetNavigationClass: function(RouteName) {
        this.currentRoute = this.currentRoute == '' ? this.$router.history.current.name : this.currentRoute;
        return this.currentRoute === RouteName ? 'currentNav' : 'nav';
      },

      ToggleCart: function() {
        this.IsCartOpen = !this.IsCartOpen;
      }
    },

    /**
     * Watch a property.
     */
    watch:{
      /**
       * Called when $route change.
       * Allows us to keep `currentRoute` up to date.
       * @param to    The new route
       * @param from  The old route
       */
      $route(to, from){
        this.currentRoute = to.name;
      }
    }
  }
</script>

<style scoped>

  .currentNav a{
    color: #aaa;
    transition: 0.5s;
  }

  .nav a {
    color: white;
    transition: 0.5s;
  }

  li {
    cursor: pointer;
  }

  li:not(last-child)::after {
    content: '';
    height: 2px;
    width: 0;
    background-color: white;
    display: block;
    position: relative;
    top: -11px;
    left: 50%;
    border: 0;
    transition: 0.3s linear;
  }

  li:not(last-child):hover::after {
    content: '';
    height: 2px;
    width: 80px;
    background-color: white;
    display: block;
    position: relative;
    top: -11px;
    left: calc(50% - 40px);
    border: 0;
  }

  li.currentNav::after,
  li.currentNav:hover::after {
    background-color: #aaa;
  }

  .container {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    padding: 0;
    margin: 0;
    height: auto;
    z-index: 999;
  }

  li {
    display: inline-block;
    color: white;
    line-height: 40px;
    width: 100%;
    text-align: center;
    position: relative;
  }

  li:last-child img {
    margin-left: auto;
    filter: invert(100%);
    vertical-align: middle;
  }

  li:last-child:after {
    height: 0;
  }

  li:last-child:hover:after {
    height: 0;
  }

  ul {
    margin: 0;
    padding: 0 30%;
    height: 40px;
    display: flex;
    justify-content: space-around;
    background-color: #333;
    opacity: 1;
  }

  li a {
    width: 100%;
    display: block;
    color: white;
    text-decoration: none;
    font-weight: 400;
    font-size: 0.95em;
  }

  @media (max-width: 1000px) {
    ul {
      padding: 0 15%;
    }
  }

  @media (max-width: 590px) {
    ul {
      padding: 0 5%;
    }

    li:hover::after {
      width: 80px;
    }

    li:last-child {
      max-width: 50px;
    }

  }

  @media (max-width: 400px) {
    ul {
      padding: 0 1%;
    }
  }


</style>
