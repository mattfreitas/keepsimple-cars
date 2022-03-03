/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/filter.js ***!
  \********************************/
window.addEventListener('load', function () {
  var filterGlobalVars = {
    availableVersions: {}
  };
  /**
   * Load models into UI requesting makeId to the endpoint using fetch.
   * 
   * @param {integer} makeId
   * @returns {void} 
   */

  function updateModelsUI(makeId) {
    var defaultModelSelectOption = '<option value="">Selecione um modelo</option>';
    var defaultVersionSelectOption = '<option value="">Todas as versões</option>';

    if (makeId == '') {
      modelSelect.innerHTML = defaultModelSelectOption;
      versionSelect.innerHTML = defaultVersionSelectOption;
      modelSelect.disabled = true;
      versionSelect.disabled = true;
      return;
    }

    getCollectionData('makes', makeId, function (data) {
      var models = data.models;
      modelSelect.innerHTML = defaultModelSelectOption;
      versionSelect.innerHTML = defaultVersionSelectOption;
      models.forEach(function (model) {
        var option = document.createElement('option');
        option.value = model.id;
        option.innerText = model.name;
        modelSelect.appendChild(option);
        filterGlobalVars.availableVersions[model.id] = model.versions;
      });
      modelSelect.disabled = false;
    });
  }
  /**
   * Load versions into UI using the global object availableVersions.
   * 
   * @returns {void}
   */


  function updateVersionsUI() {
    versionSelect.innerHTML = '<option value="">Selecione uma versão</option>';

    if (filterGlobalVars.availableVersions[modelSelect.value] == undefined) {
      versionSelect.disabled = true;
      return;
    }

    filterGlobalVars.availableVersions[modelSelect.value].forEach(function (version) {
      var option = document.createElement('option');
      option.value = version.model_id;
      option.innerText = version.name;
      versionSelect.appendChild(option);
    });
    versionSelect.disabled = false;
  }
  /**
   * Toggle the filters modal using classList.
   * 
   * @returns {void}
   */


  function toggleModalElements() {
    modalElements.forEach(function (element) {
      element.classList.toggle('hidden');
    });
  }
  /**
   * Bind elements DOM.
   */


  var vehicleTypeSelect = document.getElementById('select[name="vehicle_type"]');
  var makeSelect = document.querySelector('select[name="make"]');
  var modelSelect = document.querySelector('select[name="model"]');
  var versionSelect = document.querySelector('select[name="version"]');
  var modalElements = document.querySelectorAll('[data-toggle="makeModelVersionFilter"]');
  var overlayModalelement = document.querySelector('#overlay');
  var openFiltersButton = document.querySelector('#openFilters');
  /**
   * Bind event listeners to the UI.
   */

  makeSelect.onchange = function () {
    return updateModelsUI(makeSelect.value);
  };

  modelSelect.onchange = function () {
    return updateVersionsUI(makeSelect.value);
  };

  [openFiltersButton, overlayModalelement].forEach(function (element) {
    element.addEventListener('click', toggleModalElements);
  });
});
/******/ })()
;