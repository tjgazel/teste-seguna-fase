export const appName = 'App Imobiliário'
export const version = '1.0.0'

export const apiUrl = process.env.NODE_ENV === 'production' ? 'http://localhost:8001' : 'http://localhost:8001'

export const storage = {
  local: {
    tokenKey: 'at',
  },

  cookie: {
    tokenKey: 'at',
    expires: 60 * 60 * 2
  }
}

export default {
  appName,
  version,
  apiUrl,
  storage
}
