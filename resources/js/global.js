/**
 * Returns collection data from the API.
 * 
 * @param {string} type
 * @param {integer} id
 * @param {object|function} opt
 * @param {function} fn
 * @returns {void}
 */
window.getCollectionData = function(type, id, opt, fn)
{
    let url = `/api/${type}`;
    let thirdParamIsObject = typeof opt == 'object';

    if(typeof id !== 'undefined') {
        url += `/${id}`;
    }

    // check if opt is object
    if(thirdParamIsObject) {
        opt = Object.keys(opt)
            .map(key => `${key}=${opt[key]}`)
            .join('&');

        url += `?${opt}`;
    }

    fetch(url)
        .then(response => response.json())
        .then(jsonResponse => {
            return thirdParamIsObject ? fn(jsonResponse.data):opt(jsonResponse.data);
        });
}