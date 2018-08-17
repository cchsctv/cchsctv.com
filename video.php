<?php
/*
///##### STOP! #####\\\
DO NOT EDIT THIS FILE DIRECTLY
This file is mamanged by GIT
Contribute at https://github.com/cchsctv/cchsctv.com/
*/
$page_title = "Video";
require 'header.php';

//Select XML File to use...
$xml = simplexml_load_file("video.xml") or die("Error: Cannot create object");
//Parse url parameters and prepare attributes
$no_print = true; require 'video_fetch.php';

//Find the current year / season
$season_active = $xml->xpath('/eps/ep')[0]['year'];

//If no URL Params, display the active year / season
if ($attributes === false) {
  $year = $xml->xpath('/eps/ep')[0]['year'];
	$years = '[@year="'.$year.'"]';
	$number_videos = false;
	$attributes .= $years;
}

$xml = xml_trim($xml,$attributes);

$season_fetched = $xml[0]['year'];

if (isset($_GET['special'])) {
  $season_fetched = $season_active = "special";

}

$playlist_content = '';
for ($i = 0; $i <= count($xml)-1; $i++){
  $video_table = (string)$xml[$i]->video;
  $playlist_content .=
    '<tr><td href="#"  id="'
    .$xml[$i]->video
    .'" onclick=set_video(this.id);><a class="download" href="/episodes/'
    .$xml[$i]->video
    .'"download>('
    .pathinfo($video_table, PATHINFO_EXTENSION)
    .')</a>'
    .$xml[$i]->title
    .'<span> Aired: '
    .$xml[$i]->aired
    .'<br>Featuring: '
    .$xml[$i]->ft
    .'</span></td></tr>';
}
?>
<style type="text/css">
.yearbox {
  width: 168px;
  height: 95px;
  width: calc(25% - 6px);
  height: auto;
  background-color: #000000;
  float: left;
  border: 1px solid #ffffff;
  margin: 2px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
	cursor: pointer;
	transition: filter .1s linear;
}
.yearbox img {
  width: 100%;
}
.yearbox:hover {
	filter: brightness(1.25);
}
img {
  max-width: 100%;
  height: auto;
}
video {
  width: 100%;
  height: auto;
  display: flex;
  margin-bottom: 2px;
}
table {
  text-align: center;
  font-size: 1em;
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 96%;
  margin: 0 2%;
  color: #ffffff;
}
tbody {
  vertical-align: middle;
  align-self: center;
  cursor: pointer
}
table span {
  font-size: .8em;
  color: #888888;
}
table span a {
  float: right
}
.hover {
  background: #c30e0e;
}
tr:hover {
  background: #c30e0e;
  -webkit-transition: background .4s;
  /* Safari */
  transition: background .4s;
}
td, th {
  border-bottom: 1px solid #dddddd;
  border-top: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
.download {
  float:right;
  color: lightblue;
  text-decoration: none;
  font-size: .9em
}
.download:hover{
  color:white;
}
@media only screen and (max-width: 720px) {
  .topnav a:not(:nth-child(2)) {
	display: none;
  }
  .topnav a:nth-child(2) {
	display: inherit;
  }
  .yearbox {
	width: calc(33.33% - 6px);
  }
}
@media only screen and (max-width: 540px) {
  .yearbox {
	width: calc(50% - 6px);
  }
}
</style>

<?php
require 'topnav.php';
?>

<link href="https://vjs.zencdn.net/6.6.0/video-js.min.css" rel="stylesheet">


		<video controls id="video" class="video-js vjs-16-9 vjs-big-play-centered" preload="none" poster="ctv_images/videoblankl.jpg"
		data-setup='{"playbackRates": [1, 1.25, 1.5]}' onClick="playpause()">
		  <source id="srcvideo" src="/episodes/ctv400.mp4" >
		</video>

<script src="https://vjs.zencdn.net/6.6.0/video.min.js"></script>
<noscript>Your browser does not support JavaScript!</noscript>
		<table id=playlist style="margin-top:1rem" season_active="<?= $season_active ?>" season_fetched="<?= $season_fetched ?>" >
		  <!--
		  <tr>
			<td href="#" id="ctv400.mp4" onclick=set_video(this.id);>
			<a class="download" href="/episodes/ctv400.mp4"download>(mp4)</a>
			CTV #888 - Example Show<span>
			Aired: October 7th, 1998<br>
			Featuring: Chua's Birthday, HTML5, and XML!</span>

			</td>
		  </tr>
		-->
    <?php
    echo $playlist_content;
    ?>
		  </table>

<script type="text/javascript">
<?php
  //Remove Comments from JS before serving
  $output = file_get_contents('scripts/playlist.js');
  $pattern1 = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/';
  $pattern2 = '/\r|\n/';
  $pattern3 = '/\t+/';
  $output = preg_replace($pattern1, '', $output);
  $output = preg_replace($pattern2, '', $output);
  $output = preg_replace($pattern3, '', $output);
  $output = trim($output);
  echo($output);
?>
//Fetch URL Params, if any
get_url_params();
//Set any special filters
if (URLParams.special){
  let specials = URLParams.special.join('&special=');
  specials = 'special='+specials;
  url_ops = specials;
} else {
  url_ops = false;
}
//Main Function
autoplay();
</script>
<!--TODO: Fix functionaity in firefox-->
<div style="margin-top:1rem; display:inline-block;">
  <div class="yearbox">
	<a onclick="load_xml_doc(season_active);">
	<img src="ctv_images/arch.png" data-rjs="3">
  </a></div>
  <div class="yearbox">
  <a onclick="load_xml_doc(2018);">
  <img src="ctv_images/18arch.jpg" data-rjs="2">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2017);">
	<img src="ctv_images/17arch.jpg" data-rjs="2">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2016);">
	<img src="ctv_images/16arch.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2015);">
	<img src="ctv_images/15arch.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2014);">
	<img src="ctv_images/14arch-d.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2013);">
	<img src="ctv_images/13arch-d.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2012);">
	<img src="ctv_images/12arch-d.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2011);">
	<img src="ctv_images/11arch-d.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2010);">
	<img src="ctv_images/10arch-d.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2009);">
	<img src="ctv_images/09arch.jpg">
  </a></div>
  <div class="yearbox">
	<a onclick="load_xml_doc(2008);">
	<img src="ctv_images/08arch.jpg">
  </a></div>
  <div class="yearbox">
	<a>
	<img src="ctv_images/noprior.jpg">
  </a></div>
</div>

<?php require 'footer.php' ?>
