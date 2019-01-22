<template>
  <div class="container-loggin" v-if="Stat === 'login'">
    <h1>
      Panneau d'administration
    </h1>

    <h2>Connexion</h2>

    <div class="input-group">
      <label for="user">Utilisateur</label>
      <input ref="user" type="text" id="user" v-on:keyup.enter="Login"/>
    </div>


    <div class="input-group">
      <label for="password">Mot de passe</label>
      <input ref="password" type="password" id="password" v-on:keyup.enter="Login"/>
    </div>

    <div class="button-group">
      <button @click="Login">
        Se connecter
      </button>
    </div>

  </div> <!-- end of v-if="Stat === 'login'" -->

  <div v-else-if="Stat === 'invalidcreds'" class="container-loggin" >
    <h1>Mot de passe erroné</h1>
    <div class="button-group">
      <button @click="Stat = 'login'">
        Réessayer
      </button>
    </div>
  </div>

  <div class="logged-container" v-else-if="Stat === 'logged'">


    <div class="admin-nav">
      <div class="admin-nav-elem">
        <a href="javascript:void(0)" @click="CurrentPage = 'commandslist'"
           :style="GetNavStyle('commandslist')"
        >
          Commandes
        </a>
      </div>
      <div class="admin-nav-elem">
        <a href="javascript:void(0)" @click="CurrentPage = 'stockmanager'"
           :style="GetNavStyle('stockmanager')">
          Stock
        </a>
      </div>
      <div class="admin-nav-elem">
        <a href="javascript:void(0)" @click="CurrentPage = 'productmanager'"
           :style="GetNavStyle('productmanager')">
          Produits
        </a>
      </div>
    </div>

    <StockManager v-if="CurrentPage === 'stockmanager'">
    </StockManager>

    <ProductManager v-else-if="CurrentPage === 'productmanager'">
    </ProductManager>

    <template v-else-if="CurrentPage === 'commandslist'">
      <!--
      Tableau liste commandes reçues (plus vieilles à plus récentes)
      Champ (textarea) pour remarque sur la commande par production
      Btn pour valider le paiement de la commande (par administration)
      Puis btn pour valider l'envoi de la commande (par prod)
      -->

      <h1>Liste des commandes en cours</h1>
      <table>
        <thead>
        <tr>
          <td width="10%">Numéro</td>
          <td>Date</td>
          <td>Client</td>
          <td>Commande</td>
          <td>Remarque</td>
          <td>Enreg.</td>
          <td>Valider</td>
        </tr>
        </thead>
        <tbody>


        <tr v-for="order in orders">
          <td>#{{order.id_com}}</td>
          <td>{{FormatDate(order.date_com)}}</td>
          <td>
            <span v-html="order.nom_cli_com"></span>
            <span v-html="order.prenom_cli_com"></span>
            ({{order.sexe_cli_com}})
            <br/>
            {{order.npa_cli_com}}
            <span v-html="order.localite_cli_con"></span>
            <span v-html="order.adresse_cli_com"></span>
          </td>
          <td><button @click="displayOrder(order.id_com)" :id="'btn-'+order.id_com">Voir produits</button></td>
          <td><textarea v-model="order.remarque_com"></textarea></td>
          <td><button @click="UpdateComments(order)"><img src="../../../static/admin/save.png" style="width:20px"></button></td>
          <td><button @click="ValidateOrder(order)"><img src="../../../static/admin/vu.png" style="width:24px"></button></td>
        </tr>

        </tbody>
      </table>
    </template>
  </div>

  <div v-else  class="container-loggin" >
    <h1>Une erreur s'est produite</h1>
    <p>
      Une erreur interne s'est produite. Veuillez nous contacter afin de résoudre
      ce problème.<br/>
      Code d'erreur : {{ errorcode }}
    </p>
    <div class="button-group">
      <button @click="Stat = 'login'">
        Réessayer
      </button>
    </div>
  </div>

</template>

<script>
  import StockManager from "./StockManager";
  import ProductManager from "./ProductManager";
  export default {
    name: "Admin",
    components: {ProductManager, StockManager},
    data: function() {
      return {
        /**
         * States list :
         *      -login        : The user need to login
         *      -invalidcreds : The login attempt failed
         *      -logged       : The user is logged in
         *      -unknow       : Something went wrong
         */
        Stat: 'login',

        /**
         * Pages list :
         *      -commandslist   : Show the commands' list
         *      -stockmanager   : Show the stock manager
         *      -productmanager : Show the product manager
         */
        CurrentPage: 'commandslist',

        token: undefined,
        errorcode: undefined,
        orders: []
      };
    },

    methods: {
      /***
       *
       * @param date
       * @returns {string}
       * @constructor
       */
      FormatDate: function(date) {
        const ddate = new Date(date);
        const hours = ddate.getHours();
        const minutes = ('0' + ddate.getMinutes()).slice(-2);
        const strTime = hours + ':' + minutes + ' ';

        return ddate.getDate() +"."+
          (ddate.getMonth()+1) +"."+
          ddate.getFullYear() +" - "+strTime;
      },

      /***
       *
       * @param NavName
       * @returns {string}
       * @constructor
       */
      GetNavStyle: function(NavName) {
        if (NavName == this.CurrentPage) {
          return 'color: #aaa;';
        }
        return '';
      },
      Login: function() {
        let Self = this;

        const User     = this.$refs.user    .value.replace('?', '').replace('=', '').replace('<','');
        const Password = this.$refs.password.value.replace('?', '').replace('=', '').replace('<','');

        this.$ajax(
          'https://bottleglass.ch/api/login.php',
          'POST',
          'user='+User+'&password='+Password,
          function(xhr) {
            const Response = JSON.parse(xhr.response);

            switch(parseInt(Response.code)) {
              // Success
              case 0: {
                Self.token = Response.token;
                Self.Stat = 'logged';
                Self.UpdateData();
                break;
              }

              // Invalid creds
              case 1: {
                Self.Stat = 'invalidcreds';
                break;
              }

              // Weird
              default: {
                Self.Stat = 'unknow';
                Self.errorcode = Response.code;
                break;
              }
            }

          });
      },

      ValidateOrder: function(order) {
        let Self = this;
        this.$ajax(
          'https://bottleglass.ch/api/validateOrder.php',
          'POST',
          'd=' + encodeURIComponent(JSON.stringify(order))
          + '&token=' + Self.$parent.token,
          function(xhr) {
            console.log(xhr.response);
          }
        );
      },

      UpdateComments: function(order) {
        let Self = this;
        this.$ajax(
          'https://bottleglass.ch/api/addComments.php',
          'POST',
          'd=' + encodeURIComponent(JSON.stringify(order))
          + '&token=' + Self.$parent.token,
          function(xhr) {
            console.log(xhr.response);
          }
        );
      },

      UpdateData: function() {
        let Self = this;
        this.$ajax(
          'https://bottleglass.ch/api/getOrders.php',
          'POST',
          'token='+Self.token,
          function(xhr) {
            Self.orders = JSON.parse(xhr.response).orders;
          }
        );
      },


        displayOrder: function(id) {
          let Self = this;
            this.$ajax(
                'https://bottleglass.ch/api/getProductsByOrderId.php',
                'POST',
                'id='+id,
                function(xhr) {
                    let products = JSON.parse(xhr.response).products;
                    let textProducts = "";
                    products.forEach(function(e) {
                        textProducts = textProducts + e.quantite_pan + "x " + Self.$t(e.nom_pro)+ "<br/>";
                    });
                    document.getElementById("btn-"+id).style.display = "none";
                    document.getElementById("btn-"+id).parentNode.innerHTML = textProducts;

                }
            );
        }

    }
  }
</script>

<style scoped>

  .container-loggin {
    max-width: 500px;
    width: 70%;
    margin-left: 30%;
  }

  h2 {
    margin-bottom: 30px;
  }

  input {
    display: block;
    width: 100%;
    max-width: 230px;
    border: 1px solid black;
    padding: 5px 15px;
    border-radius: 5px;
    font-size: 1.1em;
    background-color: #F3f0FB;
  }

  label {
    font-size: 1.1em;
  }

  .input-group {
    width: 100%;
    max-width: 230px;
    margin: 10px auto;
  }

  .button-group {
    text-align: center;
    margin: 20px 0 30px 30px;
  }

  button {
    border: 1px solid black;
    padding: 10px 60px;
    font-size: 1.3em;
    transition: 0.5s;
    border-radius: 5px;
  }

  button:hover {
    background-color: #aaa;
  }

  button:active {
    background-color: #777;
  }

  .container {

  }

  /* TABLEAU COMMANDES */
  table {
    text-align:center;
    margin: 20px auto;
    border-radius: 5px;
  }

  table thead {
    background-color: #444;
    color: white;
  }

  table, td {
    border: 1px solid #000;
    border-collapse: collapse;
  }

  table td {
    padding: 5px;
  }

  table td:first-child {
    font-size: 1.1em;
  }

  table tbody tr:nth-child(odd) {
    background-color: #f3f5f0;
  }

  table thead td {
    padding:10px;
    font-size: 1.1em;
  }

  .logged-container {
    margin-top: 90px;
  }

  .admin-nav {
    background-color: navajowhite;
    position: fixed;
    left: 0;
    top: 40px;
    width: 100%;
    height: 40px;
    z-index: 9999;
    text-align: center;
  }

  .admin-nav-elem {
    display: inline-block;
    line-height: 40px;
    padding: 0 20px;
  }

  .admin-nav-elem a {
    color: black;
    text-decoration: none;
    transition: 0.5s;
  }

  .admin-nav-elem a:hover {
    color: #bbb;
  }


  @media (max-width: 580px) {
    .container-loggin {
      margin-left: 15px;
      width: 100%;
    }

    .input-group {
      width: 100%;
      max-width: unset;
    }

    input {
      width: 80%;
      max-width: unset;
    }

    .button-group {
      width: 100%;
      margin-left: 0;
    }

  }


</style>
