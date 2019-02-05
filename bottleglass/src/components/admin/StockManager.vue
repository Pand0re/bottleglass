<template>
  <div class="container">
    <h1>Gestion du stock</h1>

    <table>
      <thead>
      <tr>
        <th>Produit</th>
        <th>Type</th>
        <th>Quant.</th>
        <th>Prix</th>
        <th>Disp.</th>
      </tr>
      </thead>

      <tbody>
      <tr v-for="product in $parent.$parent.ShoppingCart">
        <td>
          {{ $t(product.nom_pro) }}
        </td>
        <td>
          <select v-model="product.cat_pro">
            <option value="VP">Verre à pieds</option>
            <option value="VC">Verre classique</option>
            <option value="BO">Bougie</option>
            <option value="PA">Pack</option>
          </select>
        </td>
        <td>
          <input type="number" min="0" max="9999"  v-model="product.quant_pro"/>
        </td>
        <td>
          <input type="number" v-model="product.prix_pro" step="0.5" min="0.1"/>
        </td>
        <td>
          <input type="checkbox" v-model="product.dispo_pro"/>
        </td>
      </tr>
      </tbody>

    </table>

    <div class="savebutton-container">
      <button class="updatebutton" @click="UpdateStock()" ref="SaveButton">
        Actualiser
      </button>
      <button class="savebutton" @click="SaveStock()" ref="SaveButton">
        Enregistrer
      </button>
    </div>

  </div>
</template>

<script>
  export default {
    name: "StockManager",
    methods: {
      SaveStock: function() {
        this.$refs.SaveButton.disabled = true;

        let Self = this;

        this.$ajax(
          'https://bottleglass.ch/api/updateStock.php',
          'POST',
          'd=' + encodeURIComponent(JSON.stringify(
            Self.$parent.$parent.ShoppingCart
          )) + '&token=' + Self.$parent.token,
          function(xhr) {
            Self.$refs.SaveButton.disabled = false;
            console.log(xhr.response);
          }
        );
      },
      UpdateStock: function() {
        this.$parent.$parent.UpdateProducts();
      }
    }
  }
</script>

<style scoped>

  .container {
    max-width: 650px;
  }

  table {
    padding: 20px 5% 20px 10%;
    width: 100%;
    max-width: 1200px;
    border-spacing: 0;
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

  tbody tr td:nth-child(3),
  tbody tr td:nth-child(4),
  tbody tr td:nth-child(5) {
    text-align: center;
  }

  select {
    padding: 5px 10px;
    border-radius: 5px;
    width: 100%;
  }

  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    opacity: 1;
    margin-left: 4px;
  }

  input[type="number"] {
    padding: 5px 10px;
    max-width: 50px;
    width: 100%;
    text-align: right;
    border-radius: 5px;
    border: 1px solid black;
  }

  .savebutton-container {
    text-align: center;
    margin-right: 20%;
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

  @media (max-width: 580px) {
    table {
      padding: 20px 1px 20px 1px;
    }
    tr th {
      padding: 10px 3px;
    }
    tbody tr td {
      padding: 5px 2px;
    }

    input[type=number] {
      width: auto;
    }

    tr td:nth-child(3) {
      width: 20px;
    }
  }

</style>
