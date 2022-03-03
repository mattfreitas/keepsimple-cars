window.addEventListener('load', function() {
    let filterGlobalVars = {
        availableVersions: {}
    };

    /**
     * Load models into UI requesting makeId to the endpoint using fetch.
     * 
     * @param {integer} makeId
     * @returns {void} 
     */
    function updateModelsUI(makeId) {
        let defaultModelSelectOption = '<option value="">Selecione um modelo</option>';
        let defaultVersionSelectOption = '<option value="">Todas as versões</option>';

        if(makeId == '') {
            modelSelect.innerHTML = defaultModelSelectOption;
            versionSelect.innerHTML = defaultVersionSelectOption;
            modelSelect.disabled = true;
            versionSelect.disabled = true;
            return;
        }
        
        getCollectionData('makes', makeId, (data) => {
            let models = data.models;

            modelSelect.innerHTML = defaultModelSelectOption;
            versionSelect.innerHTML = defaultVersionSelectOption;

            models.forEach(model => {
                let option = document.createElement('option');
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
        
        if(filterGlobalVars.availableVersions[modelSelect.value] == undefined) {
            versionSelect.disabled = true;
            return;
        }

        filterGlobalVars.availableVersions[modelSelect.value].forEach(version => {
            let option = document.createElement('option');
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
        modalElements.forEach(element => {
            element.classList.toggle('hidden');
        });
    }


    /**
     * Bind elements DOM.
     */
    const vehicleTypeSelect = document.getElementById('select[name="vehicle_type"]');
    const makeSelect = document.querySelector('select[name="make"]');
    const modelSelect = document.querySelector('select[name="model"]');
    const versionSelect = document.querySelector('select[name="version"]');
    const modalElements = document.querySelectorAll('[data-toggle="makeModelVersionFilter"]');
    const overlayModalelement = document.querySelector('#overlay');
    const openFiltersButton = document.querySelector('#openFilters');

    /**
     * Bind event listeners to the UI.
     */
    makeSelect.onchange = () => updateModelsUI(makeSelect.value);
    modelSelect.onchange = () => updateVersionsUI(makeSelect.value);
    [ openFiltersButton, overlayModalelement ].forEach(element => {
        element.addEventListener('click', toggleModalElements);
    });
});
