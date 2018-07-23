<?php

// Set this first!
define('__ROOTURI__', 'http://localhost:8080/php-viewcontroller-framework/'); //Change this to your address.
define('__ROOTPATH__', dirname(dirname(__FILE__)));

define('CONTROLLER_PATH', __ROOTPATH__.'/app/controllers/');
define('VIEW_PATH', __ROOTPATH__.'/app/views/');

define('ASSETS_PATH', __ROOTURI__.'/public/assets/');

require 'core/View.php';
require 'core/Controller.php';
require 'core/Session.php';

Session::start();

// -------------------------------------------------------------------------------------------------------------- //
// Set the CDN links here
// While working on localhost, you can create a cdn-local directory in you htdoc directory and unzip all
// 	- the neccessary css and js libraries you wish to include in this project. You will notice that we have
// 	- included the bootstrap, fontawesome, jquery and tether libraries. 
// 
// NOTE: You SHOULD change these links to the main online CDN link(s) of each library for production staging.
// -------------------------------------------------------------------------------------------------------------- //
// CSS Here.
const CSS_BOOTSTRAP = 'http://localhost:8080/cdn-local/bootstrap-4.0.0/css/bootstrap.css';
const CSS_FONTAWESOME = 'http://localhost:8080/cdn-local/font-awesome-4.7.0/css/font-awesome.css';
const CSS_TETHER = 'http://localhost:8080/cdn-local/tether-1.3.3/css/tether.css';

// JS Here.
const JS_BOOTSTRAP = 'http://localhost:8080/cdn-local/bootstrap-4.0.0/js/bootstrap.js';
const JS_JQUERY = 'http://localhost:8080/cdn-local/jquery-3.3.1/jquery-3.3.1.min.js';
const JS_TETHER = 'http://localhost:8080/cdn-local/tether-1.3.3/js/tether.js';
// -------------------------------------------------------------------------------------------------------------- //
