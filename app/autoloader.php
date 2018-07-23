<?php

// Set this first!
define('__ROOTURI__', 'http://localhost:8080/joshmvc/'); //Change this to your address.
define('__ROOTPATH__', dirname(dirname(__FILE__)));

define('CONTROLLER_PATH', __ROOTURI__.'/app/controllers/');
define('MODEL_PATH', __ROOTURI__.'/app/models/');
define('VIEW_PATH', __ROOTURI__.'/app/views/');

define('ASSETS_PATH', __ROOTURI__.'/public/assets/');

require 'core/definitions.php';

require 'core/Model.php';
require 'core/View.php';
require 'core/Controller.php';
require 'core/Session.php';

Session::start();