<?php
	if(!defined("API_INCLUDED"))
		echo "<html><head><meta http-equiv=\"refresh\" content=\"0;url=./\"></head></html>\n";
	$doc_root = substr($_SERVER['SCRIPT_FILENAME'], strlen($_SERVER['DOCUMENT_ROOT']), strrpos($_SERVER['SCRIPT_FILENAME'], "/") - strlen($_SERVER['DOCUMENT_ROOT']));

	session_start();

	function show_login($error = null) {
		global $doc_root;
		if($error == null)
			unset($error);
		echo "
	<body>
  	<form data-ajax=\"false\" method=\"post\">
  		<label for=\"password\" class=\"ui-hidden-accessible\">Password:</label>
  		<input data-clear-btn=\"true\" type=\"password\" name=\"password\" id=\"password\" placeholder=\"Password\" />
  	</form>" .
    (isset($error) ? "
  	<div class=\"error\">$error</div>" : "") .
    "</body>";
		if(version_compare(PHP_VERSION, '5.4.0', '<'))
			session_unregister("premierepro_pass");
		exit();
	}

	if(isset($_POST['logout']) && $_POST['logout'] === "true")
		if(version_compare(PHP_VERSION, '5.4.0', '<'))
			session_unregister("premierepro_pass");
		else
			unset($_SESSION['premierepro_pass']);
      include "passwd.xml";
	if(!isset($_POST['password']) && !isset($_SESSION['premierepro_pass'])) {
		show_login();
	} else {
		if(!isset($_SESSION['premierepro_pass'])) {
			$login_password = $_POST['password'];

			if($login_password === $admin_password) {
				if(version_compare(PHP_VERSION, '5.4.0', '<'))
					session_register('premierepro_pass');
				$_SESSION['premierepro_pass'] = $admin_password;
			}
			else
				show_login("Incorrect password");

			$page_location = $_SERVER['PHP_SELF'];
			if(isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING']) !== "")
				$page_location = $page_location . "?" . $_SERVER['QUERY_STRING'];
			header("Location: " . $page_location);
		} elseif($_SESSION['premierepro_pass'] !== $admin_password)
			show_login("Invalid session");
	}
?>
