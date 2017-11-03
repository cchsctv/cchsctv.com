<?php
/*
///##### STOP! #####\\\
DO NOT EDIT THIS FILE DIRECTLY
This file is mamanged by GIT
Contribute at https://github.com/cchsctv/cchsctv.com/
*/
$page_title = "Video";
require '../header.php';
require 'auth.php';
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
}
.yearbox img {
  width: 100%;
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
  .topnav a:not(:nth-child(3)) {
    display: none;
  }
  .topnav a:nth-child(3) {
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


        <video controls id="video" class="video-js vjs-16-9 vjs-big-play-centered" preload="none" poster="/ctv_images/videoblankl.jpg"
        data-setup='{"playbackRates": [1, 1.25, 1.5]}'>
          <source id="srcvideo" src="/episodes/ctv400.mp4" >
        </video>

<script src="https://vjs.zencdn.net/5.19.2/video.min.js"></script>
<noscript>Your browser does not support JavaScript!</noscript>
        <table id=playlist style="margin-top:1rem">
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
          </table>

<script type="text/javascript">

var active_year = 2018; //CHANGE THIS TO THE CURRENT YEAR

var video = document.getElementById('video');
video = videojs('video'); //video.js, remove for html5 player
var table = document.getElementById('playlist');
var source = document.createElement('source');
var srcvideo = document.getElementById('srcvideo');
var xmlhttp = new XMLHttpRequest();
var videoload = false;
var xml_load = false;
var year = false;
var active_video;
var epnum;

//load_xml_doc(active_year).then(function() {
  videoload = false;
  autoplay();
//})

video.on('ended', function() {
  if(document.getElementsByClassName("hover")[0].parentElement.nextElementSibling){
    epnum = document.getElementsByClassName("hover")[0].parentElement.nextElementSibling.childNodes[0].id
 } else if (active_video=="117"){
   window.location.href = "video.php?special=musical&autoplay";
 } else {
   epnum2file();
   load_xml_doc(year*1-1);
   epnum = table.rows[0].cells[0].id;
 }
 set_video(epnum,1);
});

function autoplay() {
  load_xml_doc(active_year);
}


function set_video(videoname){
  window.scrollTo(0,0)
  hover = document.getElementsByClassName("hover")
  while (hover.length){
    hover[0].className = hover[0].classList.remove("hover");
  };
  vurl = "/episodes/"+videoname;
  video.src(vurl);
  video.load();
  if (videoload === false){
    videoload = true;

  } else {
    video.play();
  }
  document.getElementById(videoname).classList.add("hover");
  videoname = document.getElementById(videoname).textContent;
  videoname = videoname.match(/\d\d\d/i);
  active_video = videoname
}

function epnum2file(){
  var found = xmlhttp.responseXML.evaluate("/eps/ep[title[contains(.,'"+String(epnum)+"')]]", xmlhttp.responseXML);
  getNodes(found).forEach(function (node) {
    year=node.getAttribute("year");
    epnum=node.getElementsByTagName("video")[0].childNodes[0].nodeValue;
  });
  function getNodes(iterator) {
    var nodes = [],
    next = iterator.iterateNext();
    nodes.push(next);
    return nodes;
  }
}


function load_xml_doc(year) {
  if (isNaN(year)){
    video.poster("/ctv_images/videoblankl.jpg")
  } else if(year==active_year) {
    video.poster("/ctv_images/videoblankl.jpg")
  } else {
    if (xml_load == true) {
      video.poster('/ctv_images/'+String(year).substr(-2)+'arch.jpg')
    }
  }
  return new Promise(function(resolve){
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        xml2table(xmlhttp);
        resolve("done!");
        videoload = false;
        table.rows[0].cells[0].onclick()
      }
    };
    xmlhttp.open("GET", "video_fetch.php?year="+year+"", true);
    xmlhttp.send();
    xml_load = true;
  });
}

function xml2table(xml) {
  var i;
  var xmlDoc = xml.responseXML;
  var tableTMP="";
  var x =xmlDoc.getElementsByTagName("ep")
  for (i = 0; i <x.length; i++) {
    var video_table = x[i].getElementsByTagName("video")[0].childNodes[0].nodeValue
    var title_table = x[i].getElementsByTagName("title")[0].childNodes[0].nodeValue
    var aired_table = x[i].getElementsByTagName("aired")[0].childNodes[0].nodeValue
    var featu_table = x[i].getElementsByTagName("ft")[0].childNodes[0].nodeValue

    tableTMP += "<tr><td href=\"#\"  id=\"" +
    video_table +
    "\" onclick=set_video(this.id);><a class=\"download\" href=\"/episodes/" +
    video_table +
    "\"download>("+
    //TODO handle if file has no extention
    video_table.split('.').pop() +
    ")</a>"+
    title_table  +
    "<span> Aired: " +
    aired_table +
    "<br>Featuring: " +
    featu_table +
    "</span></td></tr>";
  }
  document.getElementById("playlist").innerHTML = tableTMP;
}


</script>
<div style="margin-top:1rem; display:inline-block;">
  <div class="yearbox">
    <a href="javascript:load_xml_doc(active_year);">
    <img src="/ctv_images/arch.png" data-rjs="3">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2017);">
    <img src="/ctv_images/17arch.jpg" data-rjs="2">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2016);">
    <img src="/ctv_images/16arch.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2015);">
    <img src="/ctv_images/15arch.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2014);">
    <img src="/ctv_images/14arch-d.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2013);">
    <img src="/ctv_images/13arch-d.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2012);">
    <img src="/ctv_images/12arch-d.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2011);">
    <img src="/ctv_images/11arch-d.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2010);">
    <img src="/ctv_images/10arch-d.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2009);">
    <img src="/ctv_images/09arch.jpg">
  </a></div>
  <div class="yearbox">
    <a href="javascript:load_xml_doc(2008);">
    <img src="/ctv_images/08arch.jpg">
  </a></div>
  <div class="yearbox">
    <a>
    <img src="/ctv_images/noprior.jpg">
  </a></div>
</div>

<?php require '../footer.php' ?>
