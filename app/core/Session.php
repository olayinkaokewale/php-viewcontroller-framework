<?php

class Session {


	static function start() {
		if (session_status() == PHP_SESSION_NONE) session_start();
	}

	static function create($array) {
		foreach ($array as $key => $value) {
			$_SESSION[$key] = $value;
		}
	}

	static function get($key) {
		return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
	}

	static function destroy($array) {
		foreach ($array as $key) {
			unset($_SESSION[$key]);
		}
		//session_destroy();
	}
}