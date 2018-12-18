<template>
  <div class="container-loggin" v-if="Stat === 'login'">
    <h1>
      Panneau d'administration
    </h1>

    <h2>Connexion</h2>

    <div class="input-group">
      <label for="user">Utilisateur</label>
      <input ref="user" type="text" id="user" @submit="Login"/>
    </div>


    <div class="input-group">
      <label for="password">Mot de passe</label>
      <input ref="password" type="password" id="password" @submit="Login"/>
    </div>

    <div class="button-group">
      <button @click="Login">
        Se connecter
      </button>
    </div>

  </div>

  <div v-else-if="Stat === 'invalidcreds'" class="container-loggin" >
    <h1>Mot de passe erroné</h1>
    <div class="button-group">
      <button @click="Stat = 'login'">
        Réessayer
      </button>
    </div>
  </div>

  <div v-else-if="Stat === 'logged'">
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
          <td>Save</td>
          <td>Valider</td>
        </tr>
      </thead>
      <tbody>


      <tr v-for="order in orders">
          <td>{{order.id_com}}</td>
          <td>{{order.date_com}}</td>
          <td>{{order.nom_cli_com + order.prenom_cli_com}}</td>
          <td>6x verre classique</td>
          <td><textarea></textarea></td>
          <td><a><img src="../../../static/admin/save.png" style="width:20px"></a></td>
          <td><a><img src="../../../static/admin/vu.png" style="width:24px"></a></td>
        </tr>

      </tbody>
    </table>
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
  export default {
    name: "Admin",
    data: function() {
      return {
        Stat: 'login',
        token: undefined,
        errorcode: undefined,
        orders: [],
      };
    },

    methods: {
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

      UpdateData: function() {
          let Self = this;
          this.$ajax(
              'https://bottleglass.ch/api/getOrders.php',
              'GET',
              '',
              function(xhr) {
                  console.log(xhr);
                  Self.orders = JSON.parse(xhr.response);

              }
          );
      }
    }
  }
</script>

<style scoped>

  .container-loggin {
    max-width: 600px;
    width: 70%;
    margin-left: 20%;
  }

  input {
    display: block;
    width: 100%;
    border: 1px solid black;
    padding: 5px;
    border-radius: 5px;
    font-size: 1.1em;
    background-color: #F3f0eB;
  }

  label {
    font-size: 1.1em;
  }

  .input-group {
    margin-top: 10px;
  }

  .button-group {
    text-align: center;
    margin: 30px 0;
  }

  button {
    border: 1px solid black;
    padding: 10px 60px;
    font-size: 1.3em;
    transition: 0.5s;
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

  }

  table, td {
    border: 1px solid #000;
    border-collapse: collapse;
  }

  table td {
    padding: 5px;
  }



  table thead td {
    font-weight: bold;
    padding:10px;
  }




</style>
