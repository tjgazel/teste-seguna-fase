import Vue from 'vue'
import axios from 'axios'
import router from '../router'
import store from '../store'
import qs from 'qs'
import {LOADER} from '../store/mutations-types'
import {apiUrl, storage} from '../config'
import {localManager} from '../services/storage-service'
import {refreshToken} from '../services/auth-service'
import Toastr from '../plugins/toastr'

const http = axios.create({
  baseURL: apiUrl
})

const apiUrlExceptToken = [
  '/v1/auth/login'
]

http.interceptors.request.use(
  (request) => {
    store.commit(LOADER, true)

    if (request.method === 'post' || request.method === 'put') {
      request.data = qs.stringify(request.data)
    }

    if (!apiUrlExceptToken.includes(request.url)) {
      const token = localManager.get(storage.local.tokenKey)
      request.headers.Authorization = `${token.token_type} ${token.access_token}`
    }

    return request
  },
  (error) => {
    store.commit(LOADER, false)

    return Promise.reject(error)
  }
)

http.interceptors.response.use(
  (response) => {
    store.commit(LOADER, false)

    return response
  },
  (error) => {
    store.commit(LOADER, false)

    const originalRequest = error.config

    if (error.response.status === 401 && originalRequest.url === '/v1/auth/refresh') {
      localManager.clear()
      Toastr.error('Sessão expirada!')
      router.push({name: 'login'})

      return Promise.reject(error)
    }

    if (error.response.status === 401 && originalRequest.url !== '/v1/auth/login') {
      return refreshToken()
        .then(res => {
          originalRequest.headers.Authorization = `${res.data.token_type} ${res.data.access_token}`

          return http(originalRequest)
        })
        .catch(() => {
          Toastr.error('Sessão expirada!')
          router.push({name: 'login'})

          return Promise.reject(error)
        })
    }

    return Promise.reject(error)
  }
)

Vue.prototype.$http = http

export default http
