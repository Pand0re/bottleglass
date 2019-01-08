<template>
  <div class="container">
    <p ref="lang" v-html="$t('t.miscellaneous.lang')"></p>
    &copy; 2019 Bottle Glass. {{ $t('t.miscellaneous.AllRightsReserved') }}
  </div>
</template>

<script>
  export default {
    name: "Footer",

    mounted: function() {

      const Self = this;
      const LangChange = this.$refs.lang;

      const fr = LangChange.querySelector('#fr');
      const de = LangChange.querySelector('#de');
      const en = LangChange.querySelector('#en');

      fr.addEventListener('click', function () {
        Self.changeLang('fr');
      });
      de.addEventListener('click', function () {
        Self.changeLang('de');
      });
      en.addEventListener('click', function () {
        Self.changeLang('en');
      });
    },

    methods: {
      changeLang(lang) {
        this.$i18n.locale = lang;
      }
    }
  }
</script>

<style scoped>
  .container {
    padding-bottom: 20px;
    margin: 0;
    height: auto;
    /*background: #f3e5ab;*/
    font-size: 0.8em;
    text-align: center;
  }

  p {
    text-align: center;
  }

  p >>> span {
    color: #777;
    text-decoration: underline;
    cursor: pointer;
  }

  p >>> span:hover {
    color: black;
  }
</style>
