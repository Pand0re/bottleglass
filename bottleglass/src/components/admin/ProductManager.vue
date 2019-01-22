<template>
  <div v-if="isLoading" class="loader-container">
    <div class="loader"></div>
  </div>
  <div v-else>
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
          <textarea v-model="product.desc_pro"></textarea>
        </td>
        <td>
          <input v-model="product.img_pro"/>
        </td>
        <td>
          <a :href="product.img_pro" target="_blank">Image</a>
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
      <button class="savebutton" @click="isAddPopupOpened = true" style="margin-left: 20px">
        Ajouter un produit
      </button>
    </div>

    <div class="window-layer" v-if="isAddPopupOpened" >
      <div class="add-product-popup">
        <div class="nav-bar">
        <span class="window-title">
          Ajout d'un produit
        </span>
          <button class="close-button" @click="isAddPopupOpened = false" >
            &times;
          </button>
        </div>

        <div class="window-body">
          <div class="add-input-group">
            <label for="name">Nom</label>
            <input id="name" v-model="newProduct.nom_pro" />
          </div>
          <div class="add-input-group">
            <label for="desc">Description</label>
            <input id="desc"  v-model="newProduct.desc_pro" />
          </div>
          <div class="add-input-group">
            <label for="img">Image</label>
            <input id="img"  v-model="newProduct.img_pro"/>
          </div>

          <img class="add-img" :src="newProduct.img_pro" alt="Lien invalide"/>

          <div class="save-container">
            <button @click="isAddPopupOpened = false">
              Annuler
            </button>
            <button @click="CreateProduct()">
              Enregistrer
            </button>
          </div>
        </div>
      </div>
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
        }],
        newProduct: {
          nom_pro:'',
          desc_pro:'',
          img_pro:'./static/produits/'
        },
        isLoading: true,
        isAddPopupOpened: false
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
            Self.isLoading = false;
          }
        );
      },
      updateProducts: function() {
        let Self = this;

        this.$ajax(
          'https://bottleglass.ch/api/updateProducts.php',
          'POST',
          'd=' + encodeURIComponent(JSON.stringify(
          Self.products
          )) + '&token=' + Self.$parent.token,
          function(xhr) {
            console.log(xhr.response);
          }
        );
      },
      CreateProduct: function() {
        if (
          this.newProduct.nom_pro   === '' ||
          this.newProduct.desc_pro  === '' ||
          this.newProduct.img_pro   === ''
        ) {
          return;
        }

        let Self = this;

        this.$ajax(
          'https://bottleglass.ch/api/addProduct.php',
          'POST',
          'd=' + encodeURIComponent(JSON.stringify(
            Self.newProduct
          )) + '&token=' + Self.$parent.token,
          function(xhr) {
            Self.isAddPopupOpened = false;
            console.log(xhr.response);
            setTimeout(Self.updateProducts, 1000);
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

  textarea {
    border-radius: 5px;
    border: 1px solid black;
    width: 100%;
    min-height: 46px;
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

  .loader-container {
    margin-left: calc(50% - 50px);
    width: 100%;
    display: block;
  }

  .loader {
    width: 100px;
    height: 100px;
    border: 10px solid whitesmoke;
    border-top: 10px solid black;
    border-radius: 50%;
    animation: spin 1.5s ease-in-out infinite;
  }

  @keyframes spin {
    0% {transform: rotate(  0deg);}
    100% {transform: rotate(360deg);}
  }

  .window-title {
    line-height: 25px;
    padding-left: 5px;
  }

  .window-body {
    border-bottom: 1px solid black;
    background-color: #efefef;
    padding: 35px 25px;
  }

  .add-product-popup {
    background-color: white;
    border: 1px solid black;
    width: 800px;
    margin-left: -400px;
    left: 50%;
    position: fixed;
    top: 50%;
    margin-top: -325px;
    height: 387px;
    z-index: 9999;
    animation: slide-up 0.2s linear;
  }

  @keyframes slide-up {
    0% {
      opacity: 0;
      margin-top: -225px;
    }
    100% {
      opacity: 1;
      margin-top: -325px;
    }
  }

  .close-button {
    background-color: red;
    border: 0;
    right: 0;
    width: 25px;
    height: 25px;
    position: absolute;
    border-left: 1px solid black;
    font-size: 1.3em;
  }

  .close-button:hover {
    color: white;
  }

  .nav-bar {
    background-color: white;
    border-bottom: 1px solid black;
    height: 25px;
  }

  .add-input-group {
    margin-left: 10px;
    margin-bottom: 15px;
    width: 40%;
    min-width: 270px;
  }

  .save-container {
    margin-top: 40px;
    margin-bottom: 20px;
    text-align: center;
    width: 40%;
  }

  .save-container button {
    border: 1px solid black;
    padding: 10px 20px;
    border-radius: 5px;
    margin-top: 20px;
  }

  .save-container button:nth-child(1) {
    background-color: #e04747;
    color: white;
    margin-right: 10px;
  }

  .save-container button:nth-child(2) {
    background-color: #27af08;
    color: white;
  }

  .add-img {
    border: 1px solid black;
    border-radius: 5px;
    position: absolute;
    min-height: 100px;
    width: 400px;
    height: calc(400px * 0.75);
    left: 45%;
    top: 50px;
  }

  .window-layer {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0, 0.6);
    z-index: 88888;
  }

  @media (max-width: 810px) {
    .add-product-popup {
      width: 100%;
      margin-left: 0;
      left: 0;
    }
  }

  @media (max-width: 750px) {
    .add-img {
      min-height: 100px;
      width: 370px;
      height: calc(370px * 0.75);
      left: 45%;
      top: 50px;
    }
  }

  @media (max-width: 685px) {
    .add-img {
      min-height: 100px;
      width: 350px;
      height: calc(350px * 0.75);
      left: 46%;
      top: 70px;
    }
  }

  @media (max-width: 670px) {
    .add-img {
      position: relative;
      display: block;
      top: 0;
      left: 50%;
      margin-left: -200px;
      width: 400px;
      height: calc(400px * 0.75);
    }

    .add-input-group {
      margin-left: 10px;
      margin-bottom: 15px;
      width: 90%;
      min-width: 270px;
      max-width: 400px;
    }

    .save-container {
      margin-top: 10px;
      margin-bottom: 0;
      text-align: center;
      width: 100%;
    }

  }



  @media (max-width: 415px) {
    .add-img {
      min-height: 50px;
      height: auto;
      width: 100%;
      left: 0;
      margin-left: 0;
    }
  }

</style>
