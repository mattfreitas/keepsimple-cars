/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/global.js ***!
  \********************************/
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

/**
 * Returns collection data from the API.
 * 
 * @param {string} type
 * @param {integer} id
 * @param {object|function} opt
 * @param {function} fn
 * @returns {void}
 */
window.getCollectionData = function (type, id, opt, fn) {
  var url = "/api/".concat(type);
  var thirdParamIsObject = _typeof(opt) == 'object';

  if (typeof id !== 'undefined') {
    url += "/".concat(id);
  } // check if opt is object


  if (thirdParamIsObject) {
    opt = Object.keys(opt).map(function (key) {
      return "".concat(key, "=").concat(opt[key]);
    }).join('&');
    url += "?".concat(opt);
  }

  fetch(url).then(function (response) {
    return response.json();
  }).then(function (jsonResponse) {
    return thirdParamIsObject ? fn(jsonResponse.data) : opt(jsonResponse.data);
  });
};
/******/ })()
;