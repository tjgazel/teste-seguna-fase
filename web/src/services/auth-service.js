import http from '../plugins/axios'
import {storage} from '../config'
import {localManager} from './storage-service'
import Toastr from '../plugins/toastr'

export const hasSession = () => {
  return localManager.has(storage.local.tokenKey)
}

export const logout = () => {
  localManager.clear()
}

export const attemptLogin = async (form) => {
  return http.post('/v1/auth/login', form)
    .then(res => {
      let payload = res.data.access_token.split('.')[1]
      payload = JSON.parse(atob(payload))
      res.data.user = {name: payload.name, email: payload.email}
      localManager.set(storage.local.tokenKey, res.data)

      return Promise.resolve(res)
    })
    .catch(error => {
      if (error.response && error.response.status === 401) {
        Toastr.error('Usuário ou senha inválidos')
      }

      return errorHandler(error)
    })
}

export const refreshToken = () => {
  return http.post('/v1/auth/refresh')
    .then(res => {
      localManager.set(storage.local.tokenKey, res.data)

      return Promise.resolve(res)
    })
    .catch(error => errorHandler(error))
}

export const getUserFromLocalStorage = () => {
  if (hasSession()) {
    return localManager.get(storage.local.tokenKey).user
  }

  return false
}

const errorHandler = (error) => {
  console.log(error.response)
  localManager.clear()

  return Promise.reject(error)
}

export default {
  attemptLogin,
  hasSession,
  logout,
  refreshToken
}
