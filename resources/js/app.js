require('./bootstrap');

require('alpinejs');

var lozad = require('lozad');
window.onload = (event) => {
    // const observer = lozad('.lozad');
    const observer = lozad('.lozad', {
        load: function(el) {
            el.data = el.getAttribute('data-data');

            // Custom implementation to load an element
            // e.g. el.src = el.getAttribute('data-src');
        }
    });
    observer.observe();
};
