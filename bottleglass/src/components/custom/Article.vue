<template>
  <div class="container" :style="GetBorderSize + GetOddSize">
    <span :title="name" :style="GetFontStyle">
      {{ name }}
    </span>
    <span title="Quantité"  :style="GetCellStyle + GetFontStyle">
      <input ref="amount" v-if="!isNaN(uprice)" :value="amount" type="number"
             @change="ChangeArticleNumber" max="99" min="1"/>
      <template v-else>
        {{ amount }}
      </template>
    </span>
    <span title="Prix unitaire" :style="GetCellStyle + GetFontStyle">
      <template v-if="!isNaN(uprice)">
       {{ parseFloat(uprice).toFixed(2) }} CHF
      </template>
      <template v-else>
        {{ uprice }}
      </template>
    </span>
    <span title="Prix total" :style="GetCellStyle + GetFontStyle">
      <template v-if="!isNaN(uprice)">
        {{ (uprice * amount).toFixed(2) }} CHF
      </template>
      <template v-else>
        {{ tprice }}
      </template>
    </span>
    <span v-if="!isNaN(uprice)">
      <button class="remove" title="Supprimer l'article" @click="RemoveSelf">
        <span>
          &times;
        </span>
      </button>
    </span>
  </div>
</template>

<script>
  export default {
    name: "Article",
    props: [
      'name',
      'uprice',
      'tprice',
      'amount',
      'odd'
    ],
    computed: {
      GetOddSize: function() {
        return this.odd === 0 ? 'background-color: #F3F3FB;' : '';
      },
      GetCellStyle: function() {
        return isNaN(this.uprice) ? '' : 'text-align: right;';
      },
      GetFontStyle: function() {
        return isNaN(this.uprice) ? 'font-weight: bold;' : 'font-size: 200;';
      },
      GetBorderSize: function() {
        return isNaN(this.uprice) ?
          'border-bottom: 1px solid #999;' :
          'border-bottom: 1px solid #eee;';
      }
    },
    methods: {
      RemoveSelf: function(event) {
        this.$emit('remove');
        event.preventDefault();
      },
      ChangeArticleNumber: function(event) {
        this.$emit('change', {
          ele: this.$refs.amount,
          key: this.$vnode.key
        });
      }
    }
  }
</script>

<style scoped>

  .container {
    padding: 5px;
    width: 95%;
    margin-right: 0;
  }

  span {
    display: inline-block;
  }

  input {
    width: 45px;
    text-align: right;
    padding: 3px 5px 3px 0;
    border-radius: 3px;
    border: 1px solid #bbb;
  }

  input[type=number]::-webkit-inner-spin-button,
  input[type=number]::-webkit-outer-spin-button {
    margin-left: 4px;
    opacity: 1;
  }

  span:nth-child(1) {
    width: 40%;
  }

  span:nth-child(2) {
    width: 10%;
    margin-right: 20px;
  }

  span:nth-child(3) {
    width: 17%;
    margin-right: 20px;
  }

  span:nth-child(4) {
    width: 16%;
  }

  span:nth-child(5) {
    width: 3%;
  }

  .remove {
    border: 1px solid black;
    background-color: white;
    font-size: 1em;
    margin-left: 8px;
    transition: 0.3s linear;
    font-weight: 600;
    padding: 4px 10px 2px 5px;
    border-radius: 3px;
  }

  .remove:hover {
    background-color: red;
    color: white;
  }


</style>
