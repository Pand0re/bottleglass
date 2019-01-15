<template>
  <div>
    <h1>Gestion des produits</h1>

    <table>
      <thead>
      <tr>
        <th>Nom</th>
        <th>Desc.</th>
        <th>Image</th>
        <th>Aperçu</th>
      </tr>
      </thead>

      <tbody>
      <tr v-for="product in products">
        <td>
          <input v-model="product.nom_pro"/>
        </td>
        <td>
          <input v-model="product.desc_pro"/>
        </td>
        <td>
          <input v-model="product.img_pro"/>
        </td>
        <td>
          <a :href="product.img_pro">Image</a>
        </td>
      </tr>
      </tbody>
    </table>


    <div class="savebutton-container">
      <button class="updatebutton" @click="getProducts()" ref="SaveButton">
        Actualiser
      </button>
      <button class="savebutton" @click="updateProducts()" ref="SaveButton">
        Enregistrer
      </button>
    </div>

  </div>
</template>

<script>
  export default {
    name: "ProductManager",
    data: function() {
      return {
        products: [{
          nom_pro:'',
          desc_pro: '',
          img_pro:''
        }]
      }
    },

    mounted: function() {
      this.getProducts();
    },

    methods: {
      getProducts: function() {
        let Self = this;

        this.$ajax(
          'https://bottleglass.ch/api/getProductsList.php',
          'GET',
          'data',
          function(xhr) {
            Self.products = JSON.parse(xhr.response);
          }
        );
      },
      updateProducts: function() {
        let Self = this;

        this.$ajax(
          'https://bottleglass.ch/updateProducts.php',
          'POST',
          'd=' + encodeURIComponent(JSON.stringify(
            Self.$parent.$parent.ShoppingCart
          )) + '&token=' + Self.$parent.token,
          function(xhr) {

          }
        );
      }
    }

  }
</script>

<style scoped>

  table {
    width: 100%;
    padding: 20px 10%;
    max-width: 1200px;
    border-spacing: 0;
  }

  th {
    text-align: left;
  }

  thead {
    background-color: #444;
    color: white;
  }

  tbody tr td {
    padding: 5px;
  }

  tr th {
    padding: 10px;
  }

  tbody tr:nth-child(odd) {
    background-color: #f4f4f4;
  }

  input {
    padding: 5px 10px;
    width: calc(100% - 25px);
    border-radius: 5px;
    border: 1px solid black;
  }


  .savebutton-container {
    text-align: center;
  }

  .savebutton:disabled,
  .savebutton:disabled:hover {
    background-color: #aaa;
    color: #666;
    cursor: progress;
    border: 2px solid #555;
  }

  .savebutton:not(disabled) {
    border: 2px solid black;
    transition: 0.2s;
    outline: none;
    border-radius: 5px;
    background-color: white;
    padding: 10px 20px;
    margin-bottom: 40px;
  }

  .savebutton:not(disabled):hover {
    background-color: #ddd;
  }

  .savebutton:not(disabled):active {
    background-color: black;
    color: white;
  }

  .updatebutton:not(disabled) {
    background: white;
    border: none;
    outline: none;
    text-decoration: underline;
    transition: 0.2s;
    padding: 10px 20px;
  }

  .updatebutton:not(disabled):hover {
    text-decoration: none;
    color: white;
  }

  .updatebutton:not(disabled)::after {
    content: ' ';
    background-color: black;
    position: relative;
    width: 100px;
    height: 0;
    top: -10px;
    left: 0;
    display: block;
    transition: 0.2s;
  }


  .updatebutton:not(disabled):hover::after {
    height: 25px;
    padding-top: 10px;
    top: -25px;
    content: 'Actualiser';
  }

  .updatebutton:not(disabled):active::after {
    height: 29px;
    padding-top: 10px;
    background-color: #333;
    top: -27px;
    content: 'Actualiser';
  }

</style>
