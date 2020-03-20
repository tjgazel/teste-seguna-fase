import Vue from 'vue'
import Vuex from 'vuex'
import predios from './predios'
import apto from './apto'

import types from './mutations-types'
import {attemptLogin} from '../services/auth-service'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {predios, apto},

  state: {
    loader: false,
    user: {}
  },

  mutations: {
    [types.LOADER](state, value = true) {
      state.loader = value
    },

    [types.USER](state, obj = {}) {
      state.user = obj
    }
  },

  actions: {
    attemptLogin({commit}, form) {
      return attemptLogin(form)
        .then(res => {
          commit(types.USER, res.data.user)

          return Promise.resolve(res)
        })
    }
  }
})
