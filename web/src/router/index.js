import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import store from '../store'
import {hasSession, logout, getUserFromLocalStorage} from '../services/auth-service'
import {USER} from "../store/mutations-types";

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  guard(to, from, next)
  // Percorre as rotas correspondentes do último ao primeiro, encontrando a rota mais próxima com um título.
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title)

  // Encontre o elemento de rota mais próximo com metatags.
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags)

  // Se uma rota com um título foi encontrada, defina o título do documento
  if (nearestWithTitle) document.title = nearestWithTitle.meta.title

  // Remova todas as metatags antigas do documento
  Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el))

  // Pule as meta tags de renderização, se não houver nenhuma.
  if (!nearestWithMeta) return next()

  // Transforme as definições de meta tag em elementos no header.
  nearestWithMeta.meta.metaTags.map(tagDef => {
    const tag = document.createElement('meta')

    Object.keys(tagDef).forEach(key => {
      tag.setAttribute(key, tagDef[key])
    })

    tag.setAttribute('data-vue-router-controlled', '')

    return tag
  }).forEach(tag => document.head.appendChild(tag))

  next()
})

const guard = (to, from, next) => {
  if (to.fullPath.includes('/painel') && !hasSession()) {
    if (!hasSession()) {
      logout()

      return next({name: 'login'})
    }
  }

  if (!store.state.user.name && hasSession()) {
    const user = getUserFromLocalStorage()

    if (user) {
      store.commit(USER, user)
    }
  }
}

export default router
