<template>
  <div class="container">
    <div v-if="State === 'default'">
      <h1>Commander</h1>

      <label for="name" hidden>Nom</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/user.svg"/></span>
        <input class="form-control" id="name" placeholder="Nom" />
      </div>

      <label for="forname" hidden>Nom</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/user.svg"/></span>
        <input class="form-control" id="forname" placeholder="Prénom" />
      </div>

      <label for="mail" hidden>E-Mail</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/mail.svg"/></span>
        <input class="form-control" id="mail" placeholder="E-Mail" />
      </div>

      <label for="gender" hidden>Sexxe</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/gender.svg"/></span>
        <select class="form-control" id="gender" placeholder="Titre">
          <option selected disabled>-- Sélectionner un sexe --</option>
          <option value="man">Homme</option>
          <option value="woman">Femme</option>
        </select>
      </div>

      <label for="npa" hidden>NPA</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/hashtag.svg"/></span>
        <input class="form-control" id="npa" placeholder="NPA" />
      </div>

      <label for="locality" hidden>Localité</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/home.svg"/></span>
        <input class="form-control" id="locality" placeholder="Localité" />
      </div>

      <label for="address" hidden>Adresse</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/home.svg"/></span>
        <input class="form-control" id="address" placeholder="Adresse" />
      </div>

      <label for="country" hidden>Pays</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/flag.svg"/></span>
        <select class="form-control" id="country" placeholder="Pays">
          <option disabled selected>-- Sélectionner un pays --</option>
          <option value="swiss">Suisse</option>
          <option value="france">France</option>
        </select>
      </div>


      <h2>Panier</h2>

      <div class="cart">
        <template v-for="item in $parent.ShoppingCart">
          <div class="item">
          <span>
            {{ item.name }}
          </span>
            <span>
            <input v-model="item.amount" type="number" min="0" max="999" class="amount"/>
          </span>
            <span>
            {{ parseFloat(item.uprice).toFixed(2) }} CHF
          </span>
            <span>
            {{ parseFloat(item.uprice * item.amount).toFixed(2) }} CHF
          </span>
          </div>
        </template>
        <div class="total">
          Total : {{ GetTotalCost }} CHF
        </div>
        <div class="center">
          <button class="buy" @click="buy">
            Acheter
          </button>
        </div>
      </div>
    </div>

    <div v-else-if="State === 'bought'">
      <h1>Commande réussie</h1>
      <p>
        La commande s'est effectuée avec succès. Un mail a été envoyé
        sur votre adresse électronique afin de compléter l'achat.
      </p>
    </div>

  </div>
</template>

<script>
  import Article from "../custom/Article";
  export default {
    name: "Acheter",
    components: {Article},

    data: function() {
      return {
        State: 'default'
      };
    },

    computed: {
      GetTotalCost: function() {
        let Total = 0.;
        for (let item of this.$parent.ShoppingCart) {
          Total += item.amount * item.uprice;
        }
        return Total.toFixed(2);
      }
    },
    methods: {
      buy: function() {
        // TODO: Send an ajax request and handle failed request

        this.State = 'bought';

        this.ResetCart();
      },

      ResetCart: function() {
        for (let item of this.$parent.ShoppingCart) {
          item.amount = 0;
        }
      }
    }
  }
</script>

<style scoped>

  .container {
    margin: 60px 20%;
  }

  .title {
    font-size: 3em;
    margin-top: 20px;
  }

  .form-control {
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    display: flex;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    flex-grow: 1;
  }

  .input-group {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-align: stretch;
    -ms-flex-align: stretch;
    align-items: stretch;
    width: 100%;
    justify-content: stretch;
    margin-top: 20px;
  }

  .input-group-text {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: .375rem .75rem;
    margin-bottom: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    margin-right: -1px;
  }

  .input-group-text img {
    width: 25px;
  }

  .item span:nth-child(1) {
    width: 50%;
    display: inline-block;
  }

  .item {
    padding: 10px;
  }

  .item:nth-child(even) {
    background-color: #eee;
  }

  .item:nth-child(odd) {
    background-color: #f6f6f6;
  }

  .item span:nth-child(3),
  .item span:nth-child(4) {
    width: 18%;
    text-align: right;
    display: inline-block;
  }

  input.amount {
    text-align: right;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid black;
    width: 40px;
  }

  .total {
    padding: 15px;
    text-align: right;
  }

  .buy {
    padding: 10px 85px;
    font-size: 1.3em;
    border-radius: 5px;
    border: 2px solid #0077ff;
    color: #0077ff;
    background-color: white;
    position: relative;
    z-index: 2;
    transition: 0.4s ease-in-out;
  }

  .buy:hover {
    color: white;
  }

  .buy::after {
    content: ' ';
    position: absolute;
    width: 0;
    height: 100%;
    background-color: #0077ff;
    top: 0;
    left: 50%;
    z-index: -1;
    transition: 0.4s ease-in-out;
  }

  .buy:hover::after {
    width: 100%;
    left: 0;
  }

  .center {
    text-align: center;
  }

  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    opacity: 1;
    margin-left: 3px;
  }

  @media (min-width: 1000px) {
    .container {
      max-width: 500px;
      margin-left: calc(50% - 250px);
    }
  }

  @media (max-width: 670px) {
    .container {
      margin: 60px 10%;
    }
  }

  @media (max-width: 400px) {
    .container {
      margin: 20px 2%;
    }

    .item span:nth-child(1) {
      width: 40%;
      display: inline-block;
    }

    input.amount {
      padding: 5px 0;
    }
  }

</style>
