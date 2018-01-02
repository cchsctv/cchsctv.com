<?php
	session_start();
	session_regenerate_id();
	function show_login($error = null) {
		if($error == null)
			unset($error);
			include "admin_topnav.php";
		echo '
	<body>
	<form data-ajax="false" method="post">
		<label for="username"><p>Username:</p></label>
		<input data-clear-btn="true" type="username" name="username" id="username" placeholder="Username" />
		<label for="password"><p>Password:</p></label>
		<input data-clear-btn="true" type="password" name="password" id="password" placeholder="Password" />
		<br>
		<input type="submit" style="visibility: hidden;"/>
	</form>' .
  (isset($error) ? '<div class="error"><p>'.$error.'</p></div>' : '') .
  '</body>';
			include "../footer.php";

		exit();
	}

	if(isset($_POST['logout']) && $_POST['logout'] === "true")
		unset($_SESSION['admin_auth']);


	if(isset($_POST['username']) && isset($_POST['password'])){
		$login_username = $_POST['username'];
		$login_password = $_POST['password'];
		$xml=simplexml_load_file("passwd.xml");
		if (isset($xml->xpath('/users[user[contains(.,'."\"".$login_username."\"".')]]')[0]->user)){
			$user = $xml->xpath('/users[user[contains(.,'."\"".$login_username."\"".')]]')[0]->user;
			$username = $user[0]->username;
			$password_hash = $user[0]->password;
			$auth = password_verify($login_password, $password_hash);
		}else show_login("Invalid Login");

	    if($auth){
	        // auth okay, setup session
	        $_SESSION['admin_auth'] = $_POST['username'];
	    }else{
	        // didn't auth
	        show_login("Invalid Login");
	     }
		 }elseif(isset($_SESSION['admin_auth'])){
		 //Session previosuly authenticated
		}else{
	 	// no credentials
	    show_login();
	 }
?>
