<?php

class View {
	
	private $customScript = '';
	private $customStyle = '';
	private $title = '';
	private $mainContent = '';

	function __construct() {

	}

	// --------------------------------------------------- SETTERS/GETTERS ------------------------------------------------- //
	// TITLE GETTERS AND SETTERS
	function getTitle() {
		return $this->title;
	}
	function setTitle($title) {
		$this->title = $title;
	}

	// SCRIPT GETTERS AND SETTERS
	function getScript() {
		return $this->customScript;
	}
	function setScript($script) {
		$this->customScript = $script;
	}

	// STYLE GETTERS AND SETTERS
	function getStyle() {
		return $this->customStyle;
	}
	function setStyle($style) {
		$this->customStyle = $style;
	}

	// MAIN CONTENT GETTERS AND SETTERS
	function getMainContent() {
		return $this->mainContent;
	}
	function setMainContent($ctx) {
		$this->mainContent = $ctx;
	}

	// --------------------------------------------------- SETTERS/GETTERS ------------------------------------------------- //

	function htmlhead() {
		$content = '
			<!DOCTYPE>
			<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>'.$this->title.'</title>
				<link rel="stylesheet" href="'.CSS_BOOTSTRAP.'">
				<link rel="stylesheet" href="'.CSS_FONTAWESOME.'">
				'.$this->customStyle.'
			</head>
			<body>
		';
		echo $content;
	}

	function htmlfoot() {
		$content = '
				<script src="'.JS_JQUERY.'"></script>
				<script src="'.JS_TETHER.'"></script>
				<script src="'.JS_BOOTSTRAP.'"></script>
				'.$this->customScript.'
			</body>
			</html>
		';
		echo $content;
	}

	function mainbody() {
		$content = '
			<div>
				'.$this->mainContent.'
			</div>
		';
		echo $content;
	}


	function render() {
		// NOTE: Include any method you want to render in all views here.
		$this->htmlhead();
		$this->mainbody();
		$this->htmlfoot();
	}

	public function createAlert($msg, $col="alert-danger") {
		return '<div class="text-center alert '.$col.' alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><small>'.$msg.'</small></div>';
	}

	function showerror($err) {
		$content = '
			<div class="card bg-outline-secondary text-muted text-center mx-5 my-5">
				<div class="card-body">
					<h2>'.$err[0].'</h2>
					<hr>
					<small>'.$err[1].'</small>
				</div>
			</div>
		';
		return $content;
	}
}