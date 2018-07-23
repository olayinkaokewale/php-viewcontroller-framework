<?php

ini_set("date.timezone", "Africa/Lagos");

class Model {
	private $mysqli;
	private $numAlpha = ['R','A','9','F','1','W','G','S','H','3','E','4','Y','I','D','O','P','7','C','B','Z','U','M','5','J','L','2','Q','X','K','6','0','T','V','N','8'];

	function __construct() {
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}

	function __destruct() {
		$this->mysqli->close();
	}

	// ------------------------------------------ SETTERS/GETTERS -------------------------------------------- //
	function getMysqli() {
		return $this->mysqli;
	}
	function setMysqli($mysqli) {
		$this->mysqli = $mysqli;
	}
	// ------------------------------------------ SETTERS/GETTERS -------------------------------------------- //

	// QUERY METHOD
	function query($query) {
		return $this->mysqli->query($query);
	}

	// ------------------------------------------ CRUD OPERATIONS -------------------------------------------- //
	function create($tab, $arr=[]) {
		$ret = 0;
		if (!empty($arr)) {
			// Build the query;
			$keys = '';
			$values = '';
			foreach ($arr as $key => $value) {
				$keys .= "`".$key."`,";
				$values .= "'".$value."',";
			}
			$keys = rtrim($keys, ',');
			$values = rtrim($values, ',');
			$query = "INSERT INTO {$tab} ({$keys}) VALUES ({$values})";

			$this->mysqli->query($query);
			$ret = $this->mysqli->insert_id;
		}
		return $ret;
	}

	function read($tab, $sel, $whr, $opt="") {
		// $tab - this is the table array we want to read from.
		// $sel - this is the array value of the columns we want to select.
		// $whr - this is the where clause.
		// $opt - this is the optional query clause.

		$sels = implode(',', $sel);
		$tabs = implode(',', $tab);

		$query = "SELECT {$sels} FROM {$tabs} WHERE {$whr} {$opt}";
		return $this->feedbackRows($this->query($query));
	}

	function update($tab, $arr=[], $whr) {
		// $tab - this is the table which we want to update.
		// $arr - this is the $key=>$value we want to update.
		// $whr - this is the where clause.

		$ret = 0;
		if (!empty($arr)) {
			// Build the query;
			$key_val = '';
			foreach ($arr as $key => $value) {
				$key_val .= "`".$key."`='".$value."',";
			}
			$key_val = rtrim($key_val, ',');
			
			$query = "UPDATE {$tab} SET {$key_val} WHERE {$whr}";

			$this->mysqli->query($query);
			$ret = $this->mysqli->affected_rows;
		}
		return $ret;
	}

	function delete($tab, $whr="1=1") {
		$query = "DELETE FROM {$tab} WHERE {$whr}";
		$res = $this->query($query);
		return $this->mysqli->affected_rows;
	}
	// ------------------------------------------ CRUD OPERATIONS -------------------------------------------- //



	// ------------------------------------------ MAIN PARENT METHODS ---------------------------------------- //
	function feedback($msg, $flag=0) {
		// FLAG 1 = SUCCESS
		// FLAG 0 = ERROR
		$feedback['flag'] = $flag;
		$feedback['message'] = $msg;
		return $feedback;
	}

	function feedbackRows($get, $flag=1, $isAssoc=false, $idName="") {
		if ($get->num_rows > 0) {
			$feedback['flag'] = $flag;
			$feedback['details'] = [];
			while ($row = $get->fetch_array(MYSQLI_ASSOC)) {
				if (!$isAssoc) {
					array_push($feedback['details'], $row);
				} else {
					$feedback['details'][$row[$idName]] = $row;
				}
			}
		} else {
			$feedback = $this->feedback("data does not exist");
		}
		return $feedback;
	}

	function genRandomCode($difficulty=5) {
		$key = "";
		$l = count($this->numAlpha) - 1;
		for ($i=0; $i < $difficulty; $i++) { 
			$key .= $this->numAlpha[rand(0,$l)];
		}
		return $key;
	}

	function esc($str) {
		return $this->mysqli->real_escape_string(filter_var(strip_tags($str), FILTER_SANITIZE_STRING));
	}

	function returnVal($arr=[], $key='') {
		return (isset($arr[$key])) ? $this->esc($arr[$key]) : "";
	}

	function upload($file, $fileName, $path, $fileType) {
		/*
		/ - EXAMPLES OF VARIABLES
		/ $fileType = ['text/csv','image/png'];
		/ $path = 'uploaded/';
		/ $fileName = time().'_'.rand(1111,9999).'.png';
		*/
		if (!empty($file)) {
			//Check Type
			if ($file['error'] == 0) {
				if (is_array($fileType) && in_array($file['type'], $fileType)) {
					if (move_uploaded_file($file['tmp_name'], $path.$fileName)) {
						$feedback = $this->feedback("file upload successful",1);
					} else {
						$feedback = $this->feedback("file upload failed");
					}
				} else {
					$feedback = $this->feedback("file type is invalid");
				}
			} else {
				$feedback = $this->feedback("error uploading file");
			}
		} else {
			$feedback = $this->feedback("invalid file input");
		}
		return $feedback;
	}

	function CSVExport($arr, $data) {
		/*---------------------------------------------------------------------------
		/- Example of $arr:
		/- $arr = [
				'fileName' => 'attendance',
				'header' => ['Checkin Code', 'Name', 'Checkin Time'], 
			];

		/- Example of $data:
		/- $data = [
				['XDC4-09998990','Ciro Okewale', '5:20pm'],
				['F45D-19289092','Nola Twitch', '5:22pm'],
				['1QWF-16778288','Bade Young', '5:23pm']
			];
		/---------------------------------------------------------------------------*/
		if (is_array($arr) && !empty($arr) && !empty($data)) {
			// GENERATE THE CSV FILE.
			$filename = $arr['fileName'];
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename='.$filename.'.csv');
			$output = fopen('php://output', 'w');
			fputcsv($output, $arr['header']);

			foreach ($data as $value) {
				fputcsv($output, $value);
			}
			fclose($output);
		    exit();
		} else {
			return $this->feedback("Invalid export request");
		}
	}
	// ------------------------------------------ MAIN PARENT METHODS ---------------------------------------- //
}