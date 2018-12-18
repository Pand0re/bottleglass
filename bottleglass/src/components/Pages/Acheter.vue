<template>
  <div class="container">
    <div class="loader-container" v-if="isLoading">
      <div class="loader"></div>
    </div>

    <div v-if="State === 'default'">
      <h1>Commander</h1>

      <label for="name" hidden>Nom</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/user.svg"/></span>
        <input ref="name" class="form-control" id="name" placeholder="Nom" />
        <p class="error" v-if="bInvalidName">
          Veuillez sélectionner un nom valide.
        </p>
      </div>

      <label for="forname" hidden>Prénom</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/user.svg"/></span>
        <input ref="forname" class="form-control" id="forname" placeholder="Prénom" />
        <p class="error" v-if="bInvalidForname">
          Veuillez entrer un prénom valide.
        </p>
      </div>

      <label for="mail" hidden>E-Mail</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/mail.svg"/></span>
        <input ref="mail" class="form-control" id="mail" placeholder="E-Mail" type="email"/>
        <p class="error" v-if="bInvalidMail">
          Veuillez entrer une adresse E-Mail valide.
        </p>
      </div>

      <label for="gender" hidden>Sexe</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/gender.svg"/></span>
        <select ref="gender" class="form-control" id="gender" placeholder="Titre">
          <option selected disabled>-- Sélectionner un sexe --</option>
          <option value="H">Homme</option>
          <option value="F">Femme</option>
        </select>
        <p class="error" v-if="bInvalidGender">
          Veuillez sélectionner un genre.
        </p>
      </div>

      <label for="npa" hidden>NPA</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/hashtag.svg"/></span>
        <input ref="npa" class="form-control" id="npa" placeholder="NPA" type="number" />
        <p class="error" v-if="bInvalidNPA">
          Veuillez entrer un NPA valide.
        </p>
      </div>

      <label for="locality" hidden>Localité</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/home.svg"/></span>
        <input ref="locality" class="form-control" id="locality" placeholder="Localité" />
        <p class="error" v-if="bInvalidLocality">
          Veuillez entrer une localité valide.
        </p>
      </div>

      <label for="address" hidden>Adresse</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/home.svg"/></span>
        <input ref="address" class="form-control" id="address" placeholder="Adresse" />
        <p class="error" v-if="bInvalidAddress">
          Veuillez entrer une adresse valide.
        </p>
      </div>

      <label for="country" hidden>Pays</label>
      <div class="input-group">
        <span class="input-group-text"><img src="../../assets/vectors/flag.svg"/></span>
        <select ref="country" class="form-control" id="country" placeholder="Pays">
          <option disabled selected>-- Sélectionner un pays --</option>
          <option value="CH">Suisse</option>
          <option value="FR">France</option>
        </select>
        <p class="error" v-if="bInvalidCountry">
          Veuillez sélectionner un pays.
        </p>
      </div>


      <h2>Panier</h2>

      <div class="cart">
        <template v-for="item in $parent.ShoppingCart">
          <div class="item">
          <span>
            {{ item.nom_pro }}
          </span>
            <span>
            <input v-model="item.amount" type="number" min="0" max="999" class="amount" @input="$forceUpdate()"/>
          </span>
            <span>
            {{ parseFloat(item.prix_pro).toFixed(2) }} CHF
          </span>
            <span>
            {{ parseFloat(item.prix_pro * item.amount).toFixed(2) }} CHF
          </span>
          </div>
        </template>
        <div class="total">
          Total : {{ GetTotalCost() }} CHF
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

    <div v-else>
      <h1>Commande échouée</h1>
      <p>
        Un problème est survenu lors de la commande. Cette dernière n'a donc pas été
        effectuée. Si le problème persiste, veuillez nous contacter à l'adresse
        <a href="mailto:contact@bottleglass.ch">contact@bottleglass.ch</a> si le
        problème persiste.
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
        State: 'default',
        bInvalidName:     false,
        bInvalidForname:  false,
        bInvalidMail:     false,
        bInvalidGender:   false,
        bInvalidNPA:      false,
        bInvalidLocality: false,
        bInvalidAddress:  false,
        bInvalidCountry:  false,

        isLoading: false
      };
    },

    computed: {},
    methods: {
      /**
       * Check provided informations
       * @returns {boolean} If infos are correct
       */
      CheckInfos: function() {

        const Name      = this.$refs.name     .value;
        const Forname   = this.$refs.forname  .value;
        const Mail      = this.$refs.mail     .value;
        const NPA       = this.$refs.npa      .value;
        const Locality  = this.$refs.locality .value;
        const Address   = this.$refs.address  .value;
        const Gender    = this.$refs.gender   .value;
        const Country   = this.$refs.country  .value;

        this.bInvalidName     = Name    .length < 2;
        this.bInvalidForname  = Forname .length < 2;
        this.bInvalidAddress  = Address .length < 4;
        this.bInvalidLocality = Locality.length < 2;
        this.bInvalidMail     = !Mail.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
        this.bInvalidGender   = Gender  !== 'H'   && Gender  !== 'F' ;
        this.bInvalidCountry  = Country !== 'CH' && Country !== 'FR';
        this.bInvalidNPA      = !NPA;

        return !(
          this.bInvalidName     ||
          this.bInvalidForname  ||
          this.bInvalidMail     ||
          this.bInvalidGender   ||
          this.bInvalidNPA      ||
          this.bInvalidLocality ||
          this.bInvalidAddress  ||
          this.bInvalidCountry
        );

      },
      buy: function() {

        if (!this.CheckInfos()) {
          return;
        }

        const Name      = this.$refs.name     .value;
        const Forname   = this.$refs.forname  .value;
        const Mail      = this.$refs.mail     .value;
        const NPA       = this.$refs.npa      .value;
        const Locality  = this.$refs.locality .value;
        const Address   = this.$refs.address  .value;
        const Gender    = this.$refs.gender   .value;
        const Country   = this.$refs.country  .value;

        let Self = this;

        this.$ajax(
          'https://bottleglass.ch/api/buy.php',
          'POST',
          'email='     + Mail +
          '&name='     + Name +
          '&npa='      + NPA +
          '&locality=' + Locality +
          '&address='  + Address +
          '&gender='   + Gender +
          '&country='  + Country +
          '&forname='  + Forname +
          '&order='    + Self.GetCart()
          ,
          function(xhr) {
            // Error
            if (xhr.response !== "0") {
              Self.State = 'somethingfuckedup';
            }

            // Success
            else {
              Self.State = 'bought';
              Self.ResetCart();
            }

            Self.isLoading = false;
          }
        );

        this.isLoading = true;

      },

      ResetCart: function() {
        for (let item of this.$parent.ShoppingCart) {
          item.amount = 0;
        }
      },

      GetTotalCost: function() {
        let Total = 0.;
        for (let item of this.$parent.ShoppingCart) {
          Total += parseFloat(item.amount * item.prix_pro);
        }
        return Total.toFixed(2);
      },

      GetCart: function() {
        let order = [];

        for (let item of this.$parent.ShoppingCart) {
          if (item.amount > 0) {
            order.push({
              id: item.id_pro,
              amount: item.amount
            });
          }
        }
        return encodeURIComponent(JSON.stringify({data:order}));
      }
    }
  }
</script>

<style scoped>

  .loader-container {
    width: 100%;
    height: 100%;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 999;
    background-color: black;
  }

  .loader,
  .loader:before,
  .loader:after {
    border-radius: 50%;
  }
  .loader {
    color: #ffffff;
    font-size: 11px;
    text-indent: -99999em;
    margin: 255px auto;
    position: relative;
    width: 10em;
    height: 10em;
    box-shadow: inset 0 0 0 1em;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
  }
  .loader:before,
  .loader:after {
    position: absolute;
    content: '';
  }
  .loader:before {
    width: 5.2em;
    height: 10.2em;
    background: #000000;
    border-radius: 10.2em 0 0 10.2em;
    top: -0.1em;
    left: -0.1em;
    -webkit-transform-origin: 5.2em 5.1em;
    transform-origin: 5.2em 5.1em;
    -webkit-animation: load2 2s infinite ease 1.5s;
    animation: load2 2s infinite ease 1.5s;
  }
  .loader:after {
    width: 5.2em;
    height: 10.2em;
    background: #000000;
    border-radius: 0 10.2em 10.2em 0;
    top: -0.1em;
    left: 5.1em;
    -webkit-transform-origin: 0px 5.1em;
    transform-origin: 0px 5.1em;
    -webkit-animation: load2 2s infinite ease;
    animation: load2 2s infinite ease;
  }
  @-webkit-keyframes load2 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  @keyframes load2 {
    0% {
      -webkit-transform: rotate(0deg);
      transform: rotate(0deg);
    }
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }


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

  .error {
    color: #c72367;
    margin-top: 5px;
    margin-left: 25px;
    margin-bottom: 0;
    font-size: 0.9em;
    display: block;
    width: 100%;
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
