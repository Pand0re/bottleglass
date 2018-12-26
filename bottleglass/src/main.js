// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueCarousel from 'vue-carousel';
import VueI18n from 'vue-i18n';
import ajax from './ajax';

import fr from '../lang/fr.json';

Vue.prototype.$ajax = ajax;

Vue.config.productionTip = false;

Vue.use(VueCarousel);
Vue.use(VueI18n);

const i18n = new VueI18n({
  locale: 'fr',
  messages: {
    fr
  }
});

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  i18n,
  components: { App },
  template: '<App/>'
});

