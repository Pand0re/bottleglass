// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueI18n from 'vue-i18n';
import ajax from './ajax';
import VueCarousel from '@chenfengyuan/vue-carousel';

Vue.component(VueCarousel.name, VueCarousel);

Vue.prototype.$ajax = ajax;

Vue.config.productionTip = false;

Vue.use(VueCarousel);
Vue.use(VueI18n);

function loadJSON(url, callback) {

  var xobj = new XMLHttpRequest();
  xobj.overrideMimeType("application/json");
  xobj.open('GET', url, true);
  xobj.onreadystatechange = function () {
    if (xobj.readyState == 4 && xobj.status == "200") {
      try {
        callback(JSON.parse(xobj.responseText));
      } catch(Exception) {
        callback({t:{}})
      }
    }
  };
  xobj.send(null);
}

let Languages = {
  fr: undefined,
  en: undefined,
  de: undefined
};

function OnLanguageFileLoaded(lang, data) {
  Languages[lang] = data;

  if (!(Languages.fr && Languages.de && Languages.de)) {
    return;
  }

  const i18n = new VueI18n({
    locale: 'fr',
    messages: Languages,
    fallbackLocale: 'en'
  });

  /* eslint-disable no-new */
  new Vue({
    el: '#app',
    router,
    i18n,
    components: {App},
    template: '<App/>'
  });
}

loadJSON('./static/lang/fr.json?' + Math.random(),function(fr) {
  OnLanguageFileLoaded('fr', fr);
});
loadJSON('./static/lang/en.json?' + Math.random(),function(en) {
  OnLanguageFileLoaded('en', en);
});
loadJSON('./static/lang/de.json?' + Math.random(),function(de) {
  OnLanguageFileLoaded('de', de);
});

