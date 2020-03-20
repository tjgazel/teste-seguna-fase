import {appName} from '../config'
import Login from '../views/Login.vue'

const routes = [
  {
    path: '/',
    redirect: '/login'
  },

  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {title: `Login - ${appName}`}
  },

  {
    path: '/painel',
    component: () => import(/* webpackChunkName: "painel/Default" */ '../templates/painel/Default.vue'),
    children: [
      {
        path: '',
        redirect: '/painel/dashbord'
      },

      {
        path: '/painel/dashbord',
        name: 'painel.dashbord',
        component: () => import(/* webpackChunkName: "painel/Dashboard" */ '../views/painel/Dashboard.vue'),
        meta: {title: `Dashbord - ${appName}`}
      },

      {
        path: '/painel/predios',
        name: 'painel.predios',
        component: () => import(/* webpackChunkName: "painel/Dashboard" */ '../views/painel/Predios.vue'),
        meta: {title: `Predios - ${appName}`}
      },

      {
        path: '/painel/predios/:id/detalhes',
        name: 'painel.predios.show',
        component: () => import(/* webpackChunkName: "painel/PredioShow" */ '../views/painel/PredioShow.vue'),
        meta: {title: `Informaçôes do prédio - ${appName}`}
      },

      {
        path: '/painel/*',
        component: () => import(/* webpackChunkName: "NotFound" */ '../views/NotFound.vue'),
        meta: {title: '404 - Not Found'}
      }
    ]
  },

  {
    path: '*',
    component: () => import(/* webpackChunkName: "NotFound" */ '../views/NotFound.vue'),
    meta: {title: '404 - Not Found'}
  }
]

export default routes
