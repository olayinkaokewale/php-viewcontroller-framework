<?php

require_once '../app/views/notfound.php';

class Notfound extends Controller {
	function __construct() {
		$this->view = new NotfoundView();
	}

	function main() {
		$this->view->main();
		$this->view->render();
	}
}