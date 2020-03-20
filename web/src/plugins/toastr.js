import toastr from 'toastr'

export default {
  save: function (msg = 'Salvo com sucesso.', title = null, options = {}) {
    options = {...this.options, ...options}
    toastr.success(msg, title, options)
  },

  update: function (msg = 'Atualizado com sucesso.', title = null, options = {}) {
    options = {...this.options, ...options}
    toastr.success(msg, title, options)
  },

  remove: function (msg = 'Removido com sucesso.', title = null, options = {}) {
    options = {...this.options, ...options}
    toastr.success(msg, title, options)
  },

  success: function (msg, title = null, options = {}) {
    options = {...this.options, ...options}
    toastr.success(msg, title, options)
  },

  error: function (
    msg = 'Erro inesperado! tente novamente em alguns minutos. Se o problema persistir, informe ao administrador do sistema.',
    title = null,
    options = {}
  ) {
    options = {...this.options, ...options}
    toastr.error(msg, title, options)
  },

  warning: function (msg, title = null, options = {}) {
    options = {...this.options, ...options}
    toastr.warning(msg, title, options)
  },

  info: function (msg, title = null, options = {}) {
    options = {...this.options, ...options}
    toastr.info(msg, title, options)
  },

  options: {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: 'toast-bottom-right',
    preventDuplicates: false,
    showDuration: '300',
    hideDuration: '1000',
    timeOut: '30000',
    extendedTimeOut: '1000',
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut'
  }
}
