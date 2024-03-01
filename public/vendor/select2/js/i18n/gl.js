/*! Select2 4.0.13 | https://github.com/select2/select2/blob/master/LICENSE.md */

!(function () {
  if (jQuery && jQuery.fn && jQuery.fn.select2 && jQuery.fn.select2.amd)
    var e = jQuery.fn.select2.amd
  e.define('select2/i18n/gl', [], function () {
    return {
      errorLoading: function () {
        return 'Non foi posíbel cargar os resultados.'
      },
      inputTooLong: function (e) {
        var n = e.input.length - e.maximum
        return 1 === n ? 'Elimine un carácter' : 'Elimine ' + n + ' caracteres'
      },
      inputTooShort: function (e) {
        var n = e.minimum - e.input.length
        return 1 === n ? 'Engada un carácter' : 'Engada ' + n + ' caracteres'
      },
      loadingMore: function () {
        return 'Cargando máis resultados…'
      },
      maximumSelected: function (e) {
        return 1 === e.maximum
          ? 'Só pode seleccionar un elemento'
          : 'Só pode seleccionar ' + e.maximum + ' elementos'
      },
      noResults: function () {
        return 'Non se atoparon resultados'
      },
      searching: function () {
        return 'Buscando…'
      },
      removeAllItems: function () {
        return 'Elimina todos os elementos'
      },
    }
  }),
    e.define,
    e.require
})()
