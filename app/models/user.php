<?php

class UserModel extends Model {
	private $mysqli;
	function __construct() {
		parent::__construct();
		$this->mysqli = parent::getMysqli();
	}

	function insert($post) {
		$firstname = parent::returnVal($post, "firstname");
		$lastname = parent::returnVal($post, "lastname");
		$username = parent::returnVal($post, "username");
		$email = parent::returnVal($post, "email");
		$pass1 = parent::returnVal($post, "password");
		$pass2 = parent::returnVal($post, "password1");

		$errorMsg = [];
		if ($firstname == '') $errorMsg[] = "Invalid Firstname";
		if ($lastname == '') $errorMsg[] = "Invalid Lastname";
		if ($username == '') $errorMsg[] = "Invalid Username";
		if ($email == '') $errorMsg[] = "Invalid Email Address";
		if (strlen($pass1) < 6) $errorMsg[] = "Invalid password length. Length must be 6 characters or more";
		if ($pass1 != $pass2) $errorMsg[] = "Password does not match";

		if (empty($errorMsg)) {
			$ins = parent::create("users", [
				"firstname" => $firstname,
				"lastname" => $lastname, 
				"username" => $username, 
				"password" => md5($pass1)
			]);

			if ($ins != 0) {
				$ins2 = parent::create("email", [
					"userID" => $ins, 
					"email" => $email
				]);

				$feedback = parent::feedback("Registration successful", 1);
			} else {
				$feedback = parent::feedback("Registration failed. Try again");
			}
		} else {
			$feedback = parent::feedback(implode('<br />', $errorMsg));
		}
		return $feedback;
	}

	function login($post) {
		$username = parent::returnVal($post, "username");
		$password = parent::returnVal($post, "password");

		$errorMsg = [];
		if ($username == '') $errorMsg[] = "Username can't be empty";
		if ($password == '') $errorMsg[] = "Password can't be empty";

		if (empty($errorMsg)) {
			$pass = md5($password);
			$query = "SELECT * FROM `users` WHERE `username`='$username' AND `password`='$pass'";
			$feedback = parent::feedbackRows(parent::query($query));
		} else {
			$feedback = parent::feedback(implode('<br />', $errorMsg));
		}
		return $feedback;
	}

	function get($post) {
		$username = parent::returnVal($post, "username");
		$userID = parent::returnVal($post, "userID");

		if ($username != "") {
			$whr = "`username`='$username'";
		} elseif ($userID != "") {
			$whr = "`userID`='$userID'";
		}
		return parent::read(['users'], ['*'], $whr);
	}

	function checkLog($post) {
		$userID = parent::returnVal($post, "userID");
		$token = parent::returnVal($post, "token");

		$query = "SELECT `loginToken` FROM `users` WHERE `userID`='$userID' AND `loginToken`='$token'";
		return parent::feedbackRows(parent::query($query));
	}

	function updateToken($post) {
		$userID = parent::returnVal($post, "userID");
		$token = parent::returnVal($post, "token");

		$upd = parent::update("users", [
			'loginToken' => $token
		], "`userID`='".$userID."'");

		if ($upd != 0) {
			$feedback = parent::feedback("Token added", 1);
		} else {
			$feedback = parent::feedback("Token addition failed");
		}

		return $feedback;
	}
}