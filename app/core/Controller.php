<?php

class Controller {
	
	public function main() {
		echo "Main home page";
	}

	public function load($url, $request) {
		$post = [
			"request" => $request
		];

		$curl = curl_init();
		// You can also set the URL you want to communicate with by doing this:
		
		// We POST the data
		curl_setopt($curl, CURLOPT_POST, 1);
		// Set the url path we want to call
		curl_setopt($curl, CURLOPT_URL, $url);  
		// Make it so the data coming back is put into a string
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// Insert the data
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

		// You can also bunch the above commands into an array if you choose using: curl_setopt_array

		// Send the request
		$result = curl_exec($curl);
		return $result;
	}
}