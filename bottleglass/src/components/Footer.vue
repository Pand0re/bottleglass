<template>
  <div class="container">
    <div>
      <div class="soc-net" title="Suivez nous sur Facebook">
        <a href="https://www.facebook.com/BottleGlass-970347176484008/">
          <img src="../assets/socialnetworks/facebook-logo.svg">
        </a>
      </div>

      <div class="soc-net" title="Suivez nous sur Instagram">
        <a href="https://www.instagram.com/_bottleglass_/">
          <img src="../assets/socialnetworks/instagram-logo.svg">
        </a>
      </div>
    </div>
    
    <p ref="lang" v-html="$t('t.miscellaneous.lang')"></p>
    &copy; 2019 Bottle Glass. {{ $t('t.miscellaneous.AllRightsReserved') }}
  </div>
</template>

<script>
  export default {
    name: "Footer",

    mounted: function() {
      this.bindLangChange();
    },

    methods: {
      bindLangChange: function() {
        let Self = this;
        let LangChange = this.$refs.lang;

        let fr = LangChange.querySelector('#fr');
        let de = LangChange.querySelector('#de');
        let en = LangChange.querySelector('#en');

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
      changeLang(lang) {
        this.$i18n.locale = lang;
        setTimeout(this.bindLangChange, 400);
      }
    }
  }
</script>

<style scoped>

  .soc-net {
    display: inline-block;
    cursor: pointer;
  }

  .soc-net img {
    margin: 15px;
    width: 60px;
  }

  .container {
    color: #666;
    padding-bottom: 20px;
    margin: 0 0 25px 0;
    height: auto;
    /*background: #f3e5ab;*/
    font-size: 0.8em;
    text-align: center;
  }

  p {
    text-align: center;
    margin: 30px;
    color: black;
  }

  p >>> a {
    color: #777;
    text-decoration: underline;
    cursor: pointer;
  }

  p >>> a:hover {
    color: black;
  }
</style>
