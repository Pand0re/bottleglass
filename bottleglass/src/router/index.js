import Vue from 'vue';
import Router from 'vue-router';
import Accueil  from '@/components/Pages/Accueil';
import Acheter  from '@/components/Pages/Acheter';
import Apropos  from '@/components/Pages/Apropos';
import Produits from '@/components/Pages/Produits';
import Admin    from '@/components/Admin/Admin';

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
      path: '/Admin',
      name: 'Admin',
      component: Admin
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
