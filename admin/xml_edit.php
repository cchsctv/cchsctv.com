<?php
/*
///##### STOP! #####\\\
DO NOT EDIT THIS FILE DIRECTLY
This file is mamanged by GIT
Contribute at https://github.com/cchsctv/cchsctv.com/
*/
$page_title = "ADMIN";
require 'header.php';
require "auth.php";
?>

<style type="text/css">
textarea {
    box-sizing: border-box;
    width: 100%;
		height: calc(100vh - 60px);
}
</style>

<?php
if(isset($_POST['edited_xml'])){
	$contents = $_POST['edited_xml'];
	$contents = str_replace("&","&amp;", $contents);
	file_put_contents("video.xml", $contents, LOCK_EX);
	echo "XML Edited";
}
?>

<form data-ajax="false" method="post">
	<textarea name="edited_xml">
<?php
$contents = file_get_contents('../video.xml');
echo $contents;
;
?>
	</textarea>
	<input type="hidden" name="submit" value="true" />
	<button type="submit" data-role="button" data-mini="true">submit</button>
</form>

<form data-ajax="false" method="post">
	<input type="hidden" name="logout" value="true" />
	<button type="submit" data-role="button" data-mini="true">Log out</button>
</form>
