<template>
  <div class="container">
    <div class="lang-change-container">
      <button @click="ChangeLang('fr')">Français</button>
      <button @click="ChangeLang('de')">Allemand</button>
      <button @click="ChangeLang('en')">Anglais</button>
    </div>

    <div v-for="a in GetProperties(t)">
      <label>{{ GetKey(a) }}</label>
      <textarea :id="GetClass(a)">{{ GetText(a)}}</textarea>
    </div>

    <div class="save-container">
      <button @click="SaveData()">
        Sauvegarder
      </button>
    </div>

  </div>
</template>

<script>
  export default {
    name: "TranslationManager",

    data: function() {
      return {
        t:undefined,
        lang: 'fr',
        props: undefined
      };
    },

    mounted: function() {
      this.GetData();
    },

    methods: {
      SaveData: function() {
        for (let p of this.props) {
          const ID = this.GetClass(p);
          const VAL = document.getElementById(ID).value;

          let obj = this;

          const KEYS = this.GetKey(p).split('.');

          for (let i = 0; i < KEYS.length - 1; ++i) {
            obj = obj[KEYS[i]];
            console.log(obj);
          }

          obj[KEYS[KEYS.length - 1]] = VAL;
        }

        console.log(this.t);

      },
      ChangeLang: function(l) {
        this.lang = l;
        this.GetData();
      },
      GetData: function() {
        let Self = this;

        this.$ajax('./static/lang/' + Self.lang + '.json', 'GET', '',
          function(xhr) {
            Self.t = (JSON.parse(xhr.response).t);
          }
        );
      },
      GetKey: function(s) {
        return s.split('¬')[0];
      },
      GetText: function(s) {
        return s.split('¬')[1];
      },
      GetClass: function(s) {
        return this.GetKey(s).replace('.', '-');
      },
      GetProperties: function(o) {
        let a = [];

        if (o === undefined) {
          return a;
        }

        this.DecomposeObject(o, 0, 't', a);

        this.props = a;

        return a;
      },

      DecomposeObject: function(o, i, s, a) {
        if (typeof o !== "object") {
          a.push(s + "¬" + o);
          return;
        }

        for (let p in o) {
          this.DecomposeObject(o[p], i+1, s + '.' + p, a);
        }

      }
    }
  }
</script>

<style scoped>

  .container {
    max-width: 100%;
  }

  .container div textarea {
    display: block;
    width: 98%;
    margin-bottom: 4px;
    border-radius: 3px;
  }

  .container div {
    padding: 10px 0 10px 10px;
    width: 98%;
  }

  .lang-change-container {
    width: 100%;
    text-align: center;
  }

  .lang-change-container button {
    padding: 5px 10px;
  }

  .save-container {
    width: 100%;
    text-align: center;
  }

  .save-container button {
    padding: 5px 10px;
    border-radius: 5px;
    background-color: white;
    border: 1px solid black;
  }

</style>
