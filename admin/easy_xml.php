<?php
/*
///##### STOP! #####\\\
DO NOT EDIT THIS FILE DIRECTLY
This file is mamanged by GIT
Contribute at https://github.com/cchsctv/cchsctv.com/
*/
$page_title = "ADMIN";
require '../header.php';
require 'auth.php';
?>
<style type="text/css">
<?php include "admin_css.css"; ?>
textarea {
    box-sizing: border-box;
    width: 8em;
    height: 1.5em;
}
.aux{
  grid-area: aux;
  background-color:#383838;
  display:grid;
  grid-template-columns: 1fr 1fr;
  grid-row-gap: 0.25em;
  padding: 0.25em 0.25em;
}
@media only screen and (max-width: 720px) {
  .topnav a:not(:nth-child(4)) {
    display: none;
  }
  .topnav a:nth-child(4) {
    display: inherit;
  }
}
</style>

<?php
require 'admin_topnav.php';
$contents = "";
if(isset($_POST['stage'])){
  $year =    (isset($_POST['year']))    ? $_POST['year']:    fasle;
  $special = (isset($_POST['special'])) ? $_POST['special']: fasle;
  $title =   (isset($_POST['title']))   ? $_POST['title']:   fasle;
  $aired =   (isset($_POST['aired']))   ? $_POST['aired']:   fasle;
  $ft =      (isset($_POST['ft']))      ? $_POST['ft']:      fasle;
  $video =   (isset($_POST['video']))   ? $_POST['video']:   fasle;
  $is_safe = !(!$year ||!$title || !$aired || !$ft ||!$video);

  if($is_safe){
    $xml_staging = file_get_contents('./video.staging.xml');
    $xml_shim = "<insert></insert>";
    $xml_toadd="<insert></insert>
  <ep year=\"$year\">
   <title>$title</title>
   <aired>$aired</aired>
   <ft>$ft</ft>
   <video>$video</video>
  </ep>";
    $xml_out = str_replace($xml_shim, $xml_toadd, $xml_staging);
    file_put_contents('./video.staging.xml', $xml_out, LOCK_EX);
  }
	echo '<p>XML Staged <a href="/admin/video.php">Video Page Preview</a></p>';
}
if(isset($_POST['discard'])){
	$contents = file_get_contents('../video.xml');
	file_put_contents("video.staging.xml", $contents, LOCK_EX);
	echo '<p>Changes Discarded <a href="/admin/video.php">Video Page Preview</a></p>';
}
?>

<form  class="adminbar" data-ajax="false" method="post">
  <button style="float:left" name="discard" type="submit" data-role="button" data-mini="true">Discard Changes</button>
  <p><b>Staging Preview</b></p>
	<button style="float:right" name="stage" type="submit" data-role="button" data-mini="true">Stage Changes</button>
  <div class="aux">
  <label>Year: </label><textarea name="year"></textarea>
  <label>Sepcial: </label style="color:grey;"><textarea name="special"></textarea>
  <label>Title: </label><textarea name="title"></textarea>
  <label>Aired: </label><textarea name="aired"></textarea>
  <label>Featuring: </label><textarea name="ft"></textarea>
  <label>Filename: </label><textarea name="video"></textarea>
  </div
</form>
<?php require '../footer.php' ?>
