export const localManager = {
  has: (key) => {
    return !!window.localStorage.getItem(key)
  },

  set: (key, obj) => {
    obj = JSON.stringify(obj)
    obj = btoa(obj)
    window.localStorage.setItem(key, obj)
  },

  get: (key) => {
    let obj = window.localStorage.getItem(key)
    if (obj) {
      obj = atob(obj)
      obj = JSON.parse(obj)
    }

    return obj
  },

  remove: (keys) => {
    if (Array.isArray(keys)) {
      keys.forEach(key => window.localStorage.removeItem(key))
    } else {
      window.localStorage.removeItem(keys)
    }
  },

  clear: () => {
    window.localStorage.clear()
  }
}

export const cookieManager = {}

export default {
  localManager,
  cookieManager
}
