/**
 * Font Awsome Icons
 */
require('@fortawesome/fontawesome-free/js/all.min.js');
var $ = require( "jquery" );

/**
 * Bulma Extensions
 */
try {
    window.toast = require('bulma-toast').toast;
    window.bulmaCalendar = require('bulma-calendar');
    window.bulmaTagsinput = require('@creativebulma/bulma-tagsinput/dist/js/bulma-tagsinput.min.js');
    window.bulmaQuickview = require('bulma-quickview/dist/js/bulma-quickview.min.js');
} catch (e) { }