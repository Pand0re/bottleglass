<template>
  <div>
    <div class="left-container">
      <h2>
        <img class="info" src="../../assets/vectors/info.svg" alt="help"/>
        Procédure
      </h2>
      <p>
        Pour acheter nos produits, veuillez remplir le formulaire ci-contre.
        À la suite de son envoi, vous receverez par e-mail le compte IBAN
        où devra être versé le montant de la commande. La commande partira
        dès la réception du montant.
      </p>
    </div>
    <div class="main-container">
      <h1>Acheter nos produits</h1>
      <form method="#">
        <h2>Commande</h2>
        <div class="command">
          <div class="customer-infos">
            <div class="input-container">
              <label for="mail">Titre</label>
              <select id="country" name="country">
                <option selected disabled>-- Titre --</option>
                <option value="swiss" >Monsieur</option>
                <option value="france">Madame</option>
              </select>
            </div>
            <div class="input-container">
              <label for="name">Nom</label>
              <input type="text" id="name" name="name"/>
            </div>
            <div class="input-container">
              <label for="firstname">Prénom</label>
              <input type="text" id="firstname" name="firstname"/>
            </div>
            <div class="input-container">
              <label for="mail">Adresse E-Mail</label>
              <input type="email" id="mail" name="mail"/>
            </div>
          </div>
          <div>
            <div class="input-container">
              <label for="country">Pays</label>
              <select id="country" name="country">
                <option selected disabled>-- Pays --</option>
                <option value="swiss" >Suisse</option>
                <option value="france">France</option>
              </select>
            </div>
            <div class="input-container">
              <label for="locality">Localité</label>
              <input type="text" id="locality" name="locality"/>
            </div>
            <div class="input-container">
              <label for="npa">NPA</label>
              <input type="text" id="npa" name="npa"/>
            </div>
            <div class="input-container">
              <label for="address">Adresse</label>
              <input type="text" id="address" name="address"/>
            </div>
          </div>
        </div>

        <div class="order">
          <fieldset>
            <legend>Articles</legend>

            <Article
              name="Nom"
              amount="Quantité"
              uprice="Prix unitaire"
              tprice="Prix total"
            ></Article>

            <div class="scroll-area">
              <Article v-for="(item, key) in ShoppingCart"
                       :name="item.name"
                       :amount="item.amount"
                       :uprice="item.uprice"
                       :odd="key % 2"
                       :key="key"
                       @remove="RemoveArticle(key)"
                       @change="ChangeItemNumber"
              ></Article>
            </div>

            <div class="add-article-container">
              <input class="add-article" placeholder="Entrez le nom de l'article"/>
              <button class="add-article">+</button>
            </div>
          </fieldset>
        </div>
        <button id="order" name="buttonorder">Commander</button>
      </form>
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
        ShoppingCart: [
          {
            name: 'Bougie',
            amount: 0,
            uprice: 6.5
          },
          {
            name: 'Verre à pieds',
            amount: 0,
            uprice: 7.5
          },
          {
            name: 'Verre classique',
            amount: 8,
            uprice: 8.95
          },
          {
            name: 'Verre à pieds',
            amount: 2,
            uprice: 7.5
          },
          {
            name: 'Verre classique',
            amount: 8,
            uprice: 8.95
          },
          {
            name: 'Verre à pieds',
            amount: 2,
            uprice: 7.5
          },
          {
            name: 'Verre classique',
            amount: 8,
            uprice: 8.95
          },
          {
            name: 'Verre à pieds',
            amount: 2,
            uprice: 7.5
          },
          {
            name: 'Verre classique',
            amount: 8,
            uprice: 8.95
          },
          {
            name: 'Verre à pieds',
            amount: 2,
            uprice: 7.5
          },
          {
            name: 'Verre classique',
            amount: 8,
            uprice: 8.95
          }
        ]
      };
    },

    methods: {
      RemoveArticle: function(Index) {
        this.ShoppingCart.splice(Index, 1);
      },
      ChangeItemNumber: function(Article) {
        this.ShoppingCart[Article.key].amount = Article.ele.value;
        this.$forceUpdate();
      }
    }
  }
</script>

<style scoped>

  .main-container {
    width: 750px;
  }

  label {
    display: block;
    font-size: 1.1em;
    padding-left: 5px;
  }

  select,
  input[type="text"],
  input[type="email"] {
    border: 1px solid black;
    border-radius: 3px;
    display: block;
    font-size: 1.1em;
    padding: 5px;
    background-color: #fafafa;
  }

  select {
    width: 230px;
  }

  .input-container {
    padding-left: 20px;
    margin-bottom: 15px;
  }

  .customer-infos {
    display: inline-block;
    width: 50%;
  }

  .command {
    display: flex;
    justify-content: stretch;
  }

  .order {
    display: inline-block;
    width: 100%;
    margin-top: 10px;
  }

  .order fieldset {
    display: block;
    height: 94%;
    width: 100%;
    border-radius: 3px;
    border: 1px solid black;
    position: relative;
    padding-right: 0;
    min-height: 300px;
  }

  .order fieldset legend {
    font-size: 1.1em;
  }

  #order {
    cursor: pointer;
    margin-top: 20px;
    width: 50%;
    margin-left: 25%;
    padding: 15px 25px;
    font-size: 1.5em;
    color: #fff;
    background-color: #007bff;
    border: 1px solid #007bff;
    border-radius: 3px;
  }

  #order:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0062cc;
  }

  .add-article-container {
    border-top: 1px solid black;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 46px;
    display: flex;
    justify-content: flex-start;
  }

  input.add-article {
    flex-grow: 2;
    padding: 8px;
    padding-right: 0;
    font-size: 1em;
    border: 0;
    height: 30px;
    border-right: 1px solid black;
    display: inline-block;
  }

  button.add-article {
    padding-top: 5px;
    font-size: 2em;
    height: 100%;
    border: 0;
    display: inline-block;
  }

  .scroll-area {
    overflow: auto;
    max-height: 250px;
  }

  .left-container {
    left: 5%;
    top: 200px;
    position: absolute;
    width: 20%;
    border-radius: 3px;
    background-color: #e0e0e0;
    padding: 0 15px 15px 15px;
  }

  .left-container h2 {
    border-bottom: 1px solid #bbb;
  }

  .info {
    width: 25px;
  }

</style>
