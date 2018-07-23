<?php

require_once '../app/autoloader.php';

class Index {

	private $controller = "home";
	private $method = "main";
	private $params = [];

	// Constructor
	function __construct() {
		$url = $this->parseUrl();
		
		if (isset($url[0])) {
			if (file_exists(CONTROLLER_PATH.$url[0].'.php')) {
				$this->controller = $url[0];
			} else {
				$this->controller = "notfound";
			}
			unset($url[0]);
		}

		require_once CONTROLLER_PATH.$this->controller.'.php';
		$this->controller = new $this->controller;
		// var_dump($this->controller);

		if (isset($url[1]) && method_exists($this->controller, $url[1])) {
			$this->method = $url[1];
			unset($url[1]);
		}

		$this->params = $url ? array_values($url) : [];
		
		$a = $this->controller;
		$b = $this->method;
		$c = $this->params;

		$a->$b($c);
	}

	function parseUrl() {
		return (isset($_GET['url'])) ? explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL)) : [];
	}
}

(new Index());