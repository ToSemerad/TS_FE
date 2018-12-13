/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../sass/app.scss');
require('underscore');
require('backbone');
var $ = require('jquery');
require('tether');
require('bootstrap');

// or you can include specific pieces
// require('bootstrap-sass/javascripts/bootstrap/tooltip');
// require('bootstrap-sass/javascripts/bootstrap/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
