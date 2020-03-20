import http from '../plugins/axios'
import Toastr from '../plugins/toastr'

export const show = (id) => {
  return http.get(`/v1/apartamentos/${id}`)
    .catch(error => {
      errorHandler(error)
    })
}

export const store = (form) => {
  return http.post('/v1/apartamentos', form)
    .then(res => {
      if (res) {
        Toastr.save()
        return Promise.resolve(res)
      }
    })
    .catch(error => errorHandler(error))
}

export const update = (form) => {
  return http.put(`/v1/apartamentos/${form.id}`, form)
    .then(res => {
      if (res) {
        Toastr.update()
        return Promise.resolve(res)
      }
    })
    .catch(error => errorHandler(error))
}

export const remove = (form) => {
  return http.delete(`/v1/apartamentos/${form.id}`)
    .then(res => {
      if (res) {
        Toastr.remove()
        return Promise.resolve(res)
      }
    })
    .catch(error => errorHandler(error))
}

export const getFinalidades = () => {
  return http.get('/v1/finalidades')
    .catch(error => {
      errorHandler(error)
    })
}

const errorHandler = (error) => {
  console.log(error.response)

  if (error.response && error.response.status !== 401 & error.response.status !== 422) {
    Toastr.error()
  }

  if (error.response && error.response.status === 422) {
    Toastr.error('Corrija os erros do formulário', 'Erro de validaçâo')
  }

  return Promise.reject(error)
}

export default {
  show,
  store,
  update,
  remove,
  getFinalidades
}
