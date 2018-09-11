<?php

// Set this first!
const PRODUCTION  = false;
require 'libs/vendor/autoload.php';

// ================ THS DOES NOT CHANGE =================== //
define('__ROOTPATH__', dirname(dirname(__FILE__)));
// ======================================================== //

if (PRODUCTION) {
	define('URL', 'http://<your-url-here>'); //Change this to your address.
	define('CONTROLLER_PATH', __ROOTPATH__.'/app/controllers/');
	define('VIEW_PATH', __ROOTPATH__.'/app/views/');
	define('ASSETS_PATH', URL.'/assets/');

	// -------------------------------------------------------------------------------------------------------------- //
	// Set the CDN links here
	// While working on localhost, you can create a cdn-local directory in you htdoc directory and unzip all
	// 	- the neccessary css and js libraries you wish to include in this project. You will notice that we have
	// 	- included the bootstrap, fontawesome, jquery and tether libraries. 
	// 
	// NOTE: You SHOULD change these links to the main online CDN link(s) of each library for production staging.
	// -------------------------------------------------------------------------------------------------------------- //
	define('CSS_BOOTSTRAP', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
	define('CSS_FONTAWESOME', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	define('CSS_TETHER', '');
	define('CSS_DATATABLE', 'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css');

	// JS Here.
	define('JS_BOOTSTRAP', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
	define('JS_JQUERY', 'https://code.jquery.com/jquery-3.3.1.slim.min.js');
	define('JS_TETHER', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js');
	define('JS_JQUERY_DATATABLE', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js');
	define('JS_BS_DATATABLE', 'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js');
	// -------------------------------------------------------------------------------------------------------------- //
} else {
	define('URL', 'http://localhost:8080/php-viewcontroller-framework'); //Change this to your address.
	define('CONTROLLER_PATH', __ROOTPATH__.'/app/controllers/');
	define('VIEW_PATH', __ROOTPATH__.'/app/views/');
	define('ASSETS_PATH', URL.'/assets/');

	// -------------------------------------------------------------------------------------------------------------- //
	// Set the CDN links here
	// While working on localhost, you can create a cdn-local directory in you htdoc directory and unzip all
	// 	- the neccessary css and js libraries you wish to include in this project. You will notice that we have
	// 	- included the bootstrap, fontawesome, jquery and tether libraries. 
	// 
	// NOTE: You SHOULD change these links to the main online CDN link(s) of each library for production staging.
	// -------------------------------------------------------------------------------------------------------------- //
	// CSS Here.
	define('CSS_BOOTSTRAP', 'http://localhost:8080/cdn-local/bootstrap-4.0.0/css/bootstrap.css');
	define('CSS_FONTAWESOME', 'http://localhost:8080/cdn-local/font-awesome-4.7.0/css/font-awesome.css');
	define('CSS_TETHER', 'http://localhost:8080/cdn-local/tether-1.3.3/css/tether.css');

	// JS Here.
	define('JS_BOOTSTRAP', 'http://localhost:8080/cdn-local/bootstrap-4.0.0/js/bootstrap.js');
	define('JS_JQUERY', 'http://localhost:8080/cdn-local/jquery-3.3.1/jquery-3.3.1.min.js');
	define('JS_TETHER', 'http://localhost:8080/cdn-local/tether-1.3.3/js/tether.js');
}


require 'core/View.php';
require 'core/Controller.php';
require 'core/Session.php';
Session::start();