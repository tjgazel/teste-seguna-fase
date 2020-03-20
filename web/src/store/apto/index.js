import types from './mutations-types'
import service from '../../services/apto-service'

export default {
  namespaced: true,

  state: {
    apto: {},
    formTitle: '',
    formAction: '',
    errors: {},
    finalidades: []
  },

  mutations: {
    [types.APTO](state, payload = {}) {
      state.apto = payload
    },

    [types.FORM_TITLE](state, payload = '') {
      state.formTitle = payload
    },

    [types.FORM_ACTION](state, payload = '') {
      state.formAction = payload
    },

    [types.ERRORS](state, payload = {}) {
      state.errors = payload
    },

    [types.FINALIDADES](state, payload = []) {
      state.finalidades = payload
    }
  },

  actions: {
    async show({commit}, id) {
      const res = await service.show(id)

      commit(types.APTO, res.data)

      return res
    },

    save({commit, state}) {
      if (state.formAction === 'add') {
        return service.store(state.apto)
          .catch(error => {
            if (error.response && error.response.status === 422) {
              commit(types.ERRORS, error.response.data)
            }
          })
      } else if (state.formAction === 'edit') {
        return service.update(state.apto)
          .catch(error => {
            if (error.response && error.response.status === 422) {
              commit(types.ERRORS, error.response.data)
            }
          })
      }
    },

    remove({state}) {
      return service.remove(state.apto)
    },

    async getFinalidades({commit}) {
      const res = await service.getFinalidades()

      commit(types.FINALIDADES, res.data)

      return res
    }
  }
}
