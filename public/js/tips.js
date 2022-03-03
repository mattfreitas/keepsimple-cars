/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/tips.js ***!
  \******************************/
window.addEventListener('load', function () {
  var tipsGlobalVars = {
    vehicleTypeId: null,
    availableVersions: {}
  };
  /**
   * Toggle class for active state in vehicle type buttons. 
   * 
   * @param HTMLButtonElement button
   * @returns {void}
   */

  function toggleVehicleButtonState(element) {
    vehicleTypeButton.forEach(function (element) {
      element.classList.remove('active-vehicle-type');
    });
    element.classList.add('active-vehicle-type');
    tipsGlobalVars.vehicleTypeId = element.getAttribute('data-vehicle-type');
    form.classList.remove('blur-sm', 'pointer-events-none');
    makeSelect.value = '';
    modelSelect.innerHTML = defaultModelSelectOption;
    versionSelect.innerHTML = defaultVersionSelectOption;
  }
  /**
   * Updates the UI with the selected vehicle type and make.
   * 
   * @param {int} vehicleTypeId
   * @param {int} makeId
   */


  function updateModelsUI(vehicle_type, makeId) {
    getCollectionData('makes', makeId, {
      vehicle_type_id: vehicle_type
    }, function (data) {
      var models = data.models;
      modelSelect.innerHTML = defaultModelSelectOption;
      versionSelect.innerHTML = defaultVersionSelectOption;

      if (!models.length) {
        return showErrorNoModelsAvailable();
      }

      models.forEach(function (model) {
        var option = document.createElement('option');
        option.value = model.id;
        option.innerText = model.name;
        modelSelect.appendChild(option);
        tipsGlobalVars.availableVersions[model.id] = model.versions;
      });
      showElementsModelsAvailable();
      modelSelect.disabled = false;
    });
  }
  /**
   * Load versions into UI using the global object availableVersions.
   * 
   * @returns {void}
   */


  function updateVersionsUI() {
    versionSelect.innerHTML = '<option value="">Todas as versões</option>';

    if (tipsGlobalVars.availableVersions[modelSelect.value] == undefined) {
      versionSelect.disabled = true;
      return;
    }

    tipsGlobalVars.availableVersions[modelSelect.value].forEach(function (version) {
      var option = document.createElement('option');
      option.value = version.model_id;
      option.innerText = version.name;
      versionSelect.appendChild(option);
    });
    versionSelect.disabled = false;
  }
  /**
   * Show the error message when no model is available.
   * 
   * @returns {void}
   */


  function showErrorNoModelsAvailable() {
    errorHasnModels.classList.remove('hidden');
    elementHasModels.forEach(function (element) {
      element.classList.add('hidden');
    });
  }
  /**
   * Show the rights elements when a model is available.
   * 
   * @returns {void}
   */


  function showElementsModelsAvailable() {
    errorHasnModels.classList.add('hidden');
    elementHasModels.forEach(function (element) {
      element.classList.remove('hidden');
    });
  }
  /**
   * Bind elements DOM.
   */


  var errorHasnModels = document.querySelector('.hasnt-models');
  var elementHasModels = document.querySelectorAll('.has-models');
  var makeSelect = document.querySelector('select[name="make_id"]');
  var modelSelect = document.querySelector('select[name="model_id"]');
  var versionSelect = document.querySelector('select[name="version"]');
  var vehicleTypeButton = document.querySelectorAll('[data-vehicle-type]');
  var form = document.querySelector('form');
  /**
   * General variables
   */

  defaultModelSelectOption = '<option value="">Selecione um modelo</option>';
  defaultVersionSelectOption = '<option value="">Todas as versões</option>';
  vehicleTypeButton.forEach(function (element) {
    element.onclick = function () {
      toggleVehicleButtonState(element);
    };
  });

  makeSelect.onchange = function () {
    return updateModelsUI(tipsGlobalVars.vehicleTypeId, makeSelect.value);
  };

  modelSelect.onchange = function () {
    return updateVersionsUI(makeSelect.value);
  };
});
/******/ })()
;