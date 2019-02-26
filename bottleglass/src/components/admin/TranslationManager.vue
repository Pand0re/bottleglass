<template>
  <div class="container">

    <div class="translation-container">
      <div v-for="a in GetProperties">
        <label :for="GetClass(a)">{{ GetKey(a) }}</label><button @click="RemoveKey(a)" class="remove-button">&times;</button>
        <textarea :id="GetClass(a)" :value="GetText(a)"></textarea>
      </div>
    </div>

    <div class="save-container">
      <button :disabled="lang==='fr'" @click="ChangeLang('fr')">Français</button>
      <button :disabled="lang==='de'" @click="ChangeLang('de')">Allemand</button>
      <button :disabled="lang==='en'" @click="ChangeLang('en')">Anglais</button>
      <span></span>
      <button @click="SaveData()">
        Sauvegarder
      </button>
      <button @click="bShowAddKeyPopup=true">
        Ajouter une clé
      </button>
    </div>

    <div class="addkeypopup" v-if="bShowAddKeyPopup">
      <div>
        <label for="nkid">Nom de la clé</label>
        <input ref="kname" id="nkid" value="t."/>
      </div>
      <div>
        <label for="nkva">Valeur de la clé</label>
        <input ref="kval" id="nkva"/>
      </div>
      <div class="akcontrol">
        <button @click="AddKey()">
          Enregistrer
        </button>
        <button @click="bShowAddKeyPopup=false">
          Annuler
        </button>
      </div>
    </div>

  </div>
</template>

<script>
  export default {
    name: "TranslationManager",

    data: function() {
      return {
        t:{},
        lang: 'fr',
        props: [],
        bShowAddKeyPopup:false
      };
    },

    mounted: function() {
      this.GetData();
    },

    methods: {
      RemoveKey: function(key) {
        for (let i = 0; i < this.props.length; ++i) {
          if (this.props[i] === key) {
            this.props.splice(i, 1);
            this.$forceUpdate();
            return;
          }
        }
      },
      AddKey: function() {
        const KEY = this.$refs.kname.value;
        const VAL = this.$refs.kval.value;

        this.props.push(KEY + '¬' + VAL);

        this.bShowAddKeyPopup = false;

      },
      SaveData: function() {
        for (let p of this.props) {
          const ID = this.GetClass(p);
          const VAL = document.getElementById(ID).value;

          let obj = this;

          const KEYS = this.GetKey(p).split('.');

          for (let i = 0; i < KEYS.length - 1; ++i) {
            if (undefined === obj[KEYS[i]]) {
              obj[KEYS[i]] = {};
            }
            obj = obj[KEYS[i]];
          }

          obj[KEYS[KEYS.length - 1]] = VAL;
        }

        let Self = this;

        this.$ajax(
          'https://bottleglass.ch/api/SaveLang.php',
          'POST',
          'd=' + encodeURIComponent(JSON.stringify({t:Self.t})) +
          '&l=' + Self.lang +
          '&token=' + Self.$parent.token,
          function(xhr) {
            console.log(xhr.response)
          }
        );

      },
      ChangeLang: function(l) {
        this.lang = l;
        this.GetData();
      },
      GetData: function() {
        let Self = this;

        this.$ajax('./static/lang/' + Self.lang + '.json', 'GET', '',
          function(xhr) {
            console.log(xhr);
            Self.t = (JSON.parse(xhr.response).t);
            Self.props.length = 0;
            Self.DecomposeObject(Self.t, 0, 't', Self.props);
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
      DecomposeObject: function(o, i, s, a) {
        if (typeof o !== "object") {
          a.push(s + "¬" + o);
          return;
        }
        for (let p in o) {
          this.DecomposeObject(o[p], i+1, s + '.' + p, a);
        }
      }
    },
    computed: {
      GetProperties: function() {
        this.props.sort(function(a,b) {return a>b ? 1 : -1});
        return this.props;
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

  .translation-container {
    max-width: 650px;
  }

  .remove-button {
    float: right;
    margin-right: 6px;
    border: 1px solid black;
    background-color: red;
    color: white;
    margin-bottom: 1px;
    border-radius: 3px;
  }

  label {
    display: inline-block;
  }

  input {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid black;
    width: 90%;
  }

  .akcontrol button {
    padding: 5px 15px;
    border: 1px solid black;
  }

  .addkeypopup {
    position: fixed;
    border-radius: 5px;
    background: white;
    top: 300px;
    height: 170px;
    border: 1px solid black;
    max-width: 600px;
    left: -300px;
    margin-left: 50%;
  }

  .save-container {
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 15px 15px 15px 50px;
    left: 0;
    right: 0;
    background-color: #aaa;
  }

  .save-container span {
    border: 1px solid #666;
    margin: 10px;
    height: 20px;
  }

  .save-container button {
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 1.2em;
    background-color: white;
    border: 1px solid black;
    transition: 0.3s;
  }

  .save-container button:hover {
    background-color: #dedede;
  }

  .save-container button:active {
    background-color: #444;
  }

  @media (min-width: 800px) {
    .translation-container {
      margin-left: 10%;
    }
  }
  @media (max-width: 650px) {
    .addkeypopup {
      position: fixed;
      border-radius: 5px;
      background: white;
      top: 300px;
      height: 170px;
      border: 1px solid black;
      max-width: 100%;
      width: 100%;
      left: 0;
      margin-left: 0;
    }
  }

</style>
