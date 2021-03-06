/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../scss/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
const $ = require('jquery');

require('bootstrap');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// Tooltips
$(document).ready(function() {
    $("body").tooltip({
        selector: '[data-toggle=tooltip]',
        delay: {
            show: 100,
            hide: 200
        }
    });
});

$(document).ready(function () {
    $('#register_customerCategory').change(function() {
        if ($('select[id$="register_customerCategory"]>option:selected').text() === "Professionnel") {
            $('#register_pro').removeClass("d-none");
        }
        else {
            $('#register_pro').addClass("d-none");
        }
    });
});
