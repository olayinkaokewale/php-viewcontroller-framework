<?php

namespace JoshMVC\Libs;

class FileHandler {
	
	// constructor
	function __construct() {

	}

	// destructor
	function __destruct() {

	}

	// -------------------------------------------------- START: MAIN FUNCTIONS ------------------------------------------------ //

	// -------------------------------------------------- STOP:  MAIN FUNCTIONS ------------------------------------------------ //

	// -------------------------------------------------- START: STATIC FUNCTIONS ------------------------------------------------ //
	static function __upload($files, $destination, $constraints=[]) {
		/* ----------------------------------------------------
			PARAMETERS DEFINITIONS AND EXAMPLES
			1) $files - this contains the file element comming straight from $_FILES["input_name"] in html tag <form enctype="multipart/form-data">
			2) $destination - this is the path to the folder where the file is saved. [NOTE: this should not be url link.] example: ../images/dp/ or ../images/dp
			3) $constraints - this should be the constraints required for file to be uploaded or not. This is an array
				constraint parameters: 
				- size_limit: this is the limit of the file in bytes. [size limit for 100kb is 100*1024 = 102400]
				- accepted_format: this is an array of accepted file types [some accepted format for images are ["image/jpeg", "image/png", "image/gif"]];
				- extension: this is the string of the final file extension to be saved as.
				- file_name: this is the static name of the file to be saved. [NOTE: ONLY USEFUL WHEN FILE UPLOADED IS ONE]
				- //others would be added here....
				EXAMPLE:
				$constraints = [
					"size_limit" => 0, //value in bytes. 100kb = 100*1024
					"accepted_format" => ["image/jpeg", "image/png", "image/gif"], //must always be array.
					"extension" => "jpg",
					"file_name" => "filename.ext"
				];
		---------------------------------------------------- */
		/* ---------------------------------------------------
		EXAMPLE $_FILES["input_name"]
		--------------------------------------------------- */

		$feedback = [];
		if (!empty($files)) {
			$files = Self::filerearrange($files);
			foreach ($files as $key => $file) {
				if ($file['error'] == 0) {
					if (!isset($constraints["accepted_format"]) || (in_array($file["type"], $constraints["accepted_format"]))) {
						if (!isset($constraints["size_limit"]) || ($file["size"] <= $constraints["size_limit"])) {
							// Deal with file naming here.
							if (isset($constraints["file_name"])) {
								$finalName = $constraints["file_name"];
							} else {
								$ext = (isset($constraints["extension"])) ? $constraints["extension"] : Self::getfileext($file["name"]);
								$finalName = ($ext != "") ? time()."_".rand(11111111,99999999).".".$ext : $file["name"]."_".rand(11111111,99999999);
							}
							// done with file naming
							$destination = rtrim($destination, "/") . "/";
							if (move_uploaded_file($file["tmp_name"], $destination.$finalName)) {
								$feedback[] = ["old_name" => $file["name"], "flag" => 1, "message" => "File upload successful", "new_name" => $finalName];
							} else {
								$feedback[] = ["old_name" => $file["name"], "flag" => 0, "message" => "File upload failed: Unknown error"];
							}
						} else {
							$feedback[] = ["old_name" => $file["name"], "flag" => 0, "message" => "File rejected: File too large"];
						}
					} else {
						$feedback[] = ["old_name" => $file["name"], "flag" => 0, "message" => "File rejected: Invalid file format"];
					}
				} else {
					$feedback[] = ["old_name" => $file["name"], "flag" => 0, "message" => "Image upload failed"];
				}
			}
		}

		return $feedback;
	}

	// METHOD TO REARRANGE $_FILES into iteratable array
	static function filerearrange($arr) {
		if (is_array($arr[array_keys($arr)[0]])) {
			foreach($arr as $key => $all) {
		        foreach($all as $i => $val) {
		            $new[$i][$key] = $val;    
		        }
		    }
		} else {
			$new[] = $arr;
		}
	    
	    return $new;
	}


	static function getfileext($filename) {
		$splits = explode(".", $filename);
		$ext = (count($splits) > 1) ? $splits[(count($splits) - 1)] : "";
		return $ext;
	}
	// -------------------------------------------------- STOP:  STATIC FUNCTIONS ------------------------------------------------ //
}