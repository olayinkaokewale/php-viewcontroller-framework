<?php

require_once '../app/views/home.php';

class Home extends Controller {
	
	private $view;

	function __construct() {
		$this->view = new HomeView();
	}

	public function main() {
		($this->view)->main();
		($this->view)->render();
	}
}