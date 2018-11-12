import Vue from 'vue';
import Router from 'vue-router';
import Accueil  from '@/components/Pages/Accueil';
import Acheter  from '@/components/Pages/Acheter';
import Apropos  from '@/components/Pages/Apropos';
import Produits from '@/components/Pages/Produits';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Accueil',
      component: Accueil
    },
    {
      path: '/Acheter',
      name: 'Acheter',
      component: Acheter
    },
    {
      path: '/A-Propos',
      name: 'Apropos',
      component: Apropos
    },
    {
      path: '/Produits',
      name: 'Produits',
      component: Produits
    },
    {
      /* Redirect invalid paths to `Accueil` */
      path: '*',
      name: 'Default',
      component: Accueil
    }
  ],
  mode: "history"
});
