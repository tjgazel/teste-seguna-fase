import types from './mutations-types'
import service from '../../services/predios-service'

export default {
  namespaced: true,

  state: {
    predios: [],
    predio: {},
    formTitle: '',
    formAction: '',
    errors: {}
  },

  mutations: {
    [types.PREDIOS](state, payload = []) {
      state.predios = payload
    },

    [types.PREDIO](state, payload = {}) {
      state.predio = payload
    },

    [types.FORM_TITLE](state, payload = '') {
      state.formTitle = payload
    },

    [types.FORM_ACTION](state, payload = '') {
      state.formAction = payload
    },

    [types.ERRORS](state, payload = {}) {
      state.errors = payload
    }
  },

  getters: {
    enderecoPredio: state => {
      if (state.predio.id) {
        return `${state.predio.logradouro}, ${state.predio.numero} ${state.predio.complemento || ''},
        ${state.predio.bairro}, ${state.predio.cidade}, ${state.predio.estado}, ${state.predio.cep}`
      }
    },

    enderecoFull: () => item => {
      return `${item.logradouro}, ${item.numero} ${item.complemento || ''},
        ${item.bairro}, ${item.cidade}, ${item.estado}, ${item.cep}`
    }
  },

  actions: {
    async list({commit}) {
      const res = await service.list()

      commit(types.PREDIOS, res.data)

      return res
    },

    async show({commit}, id) {
      const res = await service.show(id)

      commit(types.PREDIO, res.data)

      return res
    },

    save({commit, state}) {
      if (state.formAction === 'add') {
        return service.store(state.predio)
          .catch(error => {
            if (error.response && error.response.status === 422) {
              commit(types.ERRORS, error.response.data)
            }
          })
      } else if (state.formAction === 'edit') {
        return service.update(state.predio)
          .catch(error => {
            if (error.response && error.response.status === 422) {
              commit(types.ERRORS, error.response.data)
            }
          })
      }
    },

    remove({state}) {
      return service.remove(state.predio)
    }
  }
}
