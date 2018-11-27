<template>
  <div class="container-loggin" v-if="Stat === 'login'">
    <h1>
      Panneau d'administration
    </h1>

    <h2>Connexion</h2>

    <div class="input-group">
      <label for="user">Utilisateur</label>
      <input ref="user" type="text" id="user"/>
    </div>


    <div class="input-group">
      <label for="password">Mot de passe</label>
      <input ref="password" type="password" id="password" />
    </div>

    <div class="button-group">
      <button @click="Login">
        Se connecter
      </button>
    </div>

  </div>

  <div v-else-if="Stat === 'invalidcreds'" class="container-loggin" >
    <h1>Mot de passe éroné</h1>
    <div class="button-group">
      <button @click="Stat = 'login'">
        Réessayer
      </button>
    </div>
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
        orders: []
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

          switch(Response.code) {
            // Success
            case 0: {
              Self.token = Response.token;
              Self.Stat = 'logged';
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
        this.$ajax('')
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

</style>
