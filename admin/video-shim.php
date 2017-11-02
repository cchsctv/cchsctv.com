<?php
require 'admin_topnav.php';
if(isset($_POST['commit'])){
$contents = file_get_contents('video.staging.xml');
file_put_contents("../video.xml", $contents, LOCK_EX);
echo '<p>Changes Commited. See them on the <a href="/video.php">Main Site</a>';
}
if(isset($_POST['discard'])){
	$contents = file_get_contents('../video.xml');
	file_put_contents("video.staging.xml", $contents, LOCK_EX);
	echo '<p>Changes Discarded';
}
?>
<style type="text/css">
<?php include "admin_css.css"; ?>
</style>
<div >
  <form class="adminbar" data-ajax="false" method="post">
    <button name="discard" type="submit" data-role="button" data-mini="true">Discard Staged Changes</button>
    <p><b>Staging Preview</b></p>
    <button name="commit" type="submit" data-role="button" data-mini="true">Commit Staged Changes</button>
  </form>
</div>
<link href="https://vjs.zencdn.net/5.19.2/video-js.min.css" rel="stylesheet">
