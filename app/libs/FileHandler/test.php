<?php
	require_once ('FileHandler.class.php');
	use JoshMVC\Libs\FileHandler as fHandler;


	if (isset($_POST["is_submit"])) {
		echo "<pre>", print_r(fHandler::__upload($_FILES["fileName"], "uploads/"), true), "</pre>";
	}

?>
<!DOCTYPE html>
<html>
	<body>
		<form method="POST" enctype="multipart/form-data">
			<input type="file" name="fileName[]" multiple />
			<input type="submit" value="submit" name="is_submit">
		</form>
	</body>
</html>