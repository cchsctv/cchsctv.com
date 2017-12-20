<?php
/*
///##### STOP! #####\\\
DO NOT EDIT THIS FILE DIRECTLY
This file is mamanged by GIT
Contribute at https://github.com/cchsctv/cchsctv.com/
*/
$page_title = "Video";
require 'header.php';
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

<link href="https://vjs.zencdn.net/5.19.2/video-js.min.css" rel="stylesheet">


		<video controls id="video" class="video-js vjs-16-9 vjs-big-play-centered" preload="none" poster="ctv_images/videoblankl.jpg"
		data-setup='{"playbackRates": [1, 1.25, 1.5]}' onClick="playpause()">
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
video = videojs('video'); 
var table = document.getElementById('playlist');
var source = document.createElement('source');
var srcvideo = document.getElementById('srcvideo');
var xmlhttp = new XMLHttpRequest();
var videoload = false;
var xml_load = false;
var url_ops = false;
var year = false;
var active_video;
var videoname;
var epnum;
var URLParams = {};

//Fetch URL Params, if any
get_url_params();
//Main Function
autoplay();

//Logic, Decides what video to play next on video end
video.on('ended', function() {
	//If the next video exists in the table, set the "epnum" to it
	if(document.getElementsByClassName("hover")[0].parentElement.nextElementSibling){
		videoname = document.getElementsByClassName("hover")[0].parentElement.nextElementSibling.childNodes[0].id;
	} 
	//If there are URL operators, set "epnum" to 
	else if (url_ops) {
		videoname = table.rows[0].cells[0].id;
	} 
	//If the last episode is finished, redirect to musicals
	else if (active_video=="117"){
		window.location.href = "video.php?special=musical&autoplay";
	} 
	//If no other conditions met, go to the previous year
	else {
		epnum2file();							//Get the filename, sets "epnum" and "year" of ended video
		load_xml_doc(year*1-1);					//Go to the previous year
		videoname = table.rows[0].cells[0].id;		//Set "epnum" the sirst episode in that year
	}
	set_video(videoname);		//Set video to "epnum"
});

function playpause() {
	//Obsolete as this is the default behaviour in video.js
	/*
  if (video.paused){
	video.play();
  } else {
	video.pause();
  }
  */
}

function autoplay() {
  //Filter for the "sepcial" URL Param
	if (URLParams.special){
		//Joins multiple "special" Params into 1 query
		for (i = 0; i < URLParams.special.length; i++){
			url_ops=URLParams.special.join("\&special=");
			url_ops="special="+url_ops
		}
		//Assemble query
		xmlhttp.open("GET", "video_fetch.php?"+url_ops+"", true);
		xmlhttp.send();		//Send query
		xml_load = true;

		return new Promise(function(resolve){
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					xml2table(xmlhttp);		//Send the response to table
					table.rows[0].cells[0].onclick();		//Sets the video to be played
					//If an episode was specified also, set the video to be played
					if (URLParams.episode) {
						epnum=URLParams.episode[0];		//Gets the top episode in table
						epnum2file();
						videoload = false;
						set_video(videoname);
					}
				}
			};
		});
	} 
	//If episode was specified in URL Params...
	else if (URLParams.episode){
		epnum=URLParams.episode[0];		//Value from the first in array, just in case multiple were specified
		//Query server to find year of the episode
		xmlhttp.open("GET", "video_fetch.php?episode2year="+epnum+"", true);
		xmlhttp.send();
		xml_load = true;
		return new Promise(function(resolve){
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					epnum2file();
					load_xml_doc(year).then(function() {
						get_url_params();
						videoload = false;
						set_video(videoname);
					})
				}
			};
		});
	} 
	//If year was specified in URL Params...
	else if (URLParams.year){
		load_xml_doc(URLParams.year);
		//If the episode was also specified in URL Params..
		if (URLParams.episode) {
			epnum=URLParams.episode[0];
			epnum2file();
			videoload = false;
			set_video(videoname);
		}
	}
	//If no year or episode was specified in URL Params...
	else {
		load_xml_doc(active_year);
	}
	//If autoplay was specified in URL Params
	if (URLParams.autoplay){
		setTimeout(function() {
			video.play();
			videoload = "true";
		}, 1000);
	}
}


function set_video(videoname){
	window.scrollTo(0,0);		//Scroll to the top
	hover = document.getElementsByClassName("hover");		//Gets the current "hover" element
	
	//Removes the "hover" from the "hover" element
	while (hover.length){
		hover[0].className = hover[0].classList.remove("hover");
	};
	
	//Point the player to the video
	vurl = "/episodes/"+videoname;
	video.src(vurl);
	video.load();
	
	//Set "videoload" to true, or if already true, play the video
	if (videoload === false){
		videoload = true;
	} else {
		video.play();
	}
	
	document.getElementById(videoname).classList.add("hover"); //Add "hover" to the currrently playing video
	
	//Get the first 3 numbers in the title of the episode and...
	videoname = document.getElementById(videoname).textContent;
	videoname = videoname.match(/\d\d\d/i);
	//Set the corrosponding URL Parameter
	if (url_ops){
		//Even if there are existing URL Params
		change_url("","video.php?"+url_ops+"\&episode="+videoname)
	} else {
		change_url("","video.php?episode="+videoname)
	}
	active_video = videoname
}

//Func: It changes the URL.
function change_url(title, url) {
	var obj = { Title: title, Url: url };
	history.replaceState(obj, obj.Title, obj.Url);
}

//Func: Searcher that gets the "epnum" and "year" from the "responseXML"
function epnum2file(){
	//XPath Expression to select episode
	var found = xmlhttp.responseXML.evaluate("/eps/ep[title[contains(.,'"+String(epnum)+"')]]", xmlhttp.responseXML, null, XPathResult.ORDERED_NODE_ITERATOR_TYPE, null);
	getNodes(found).forEach(function (node) {
		year=node.getAttribute("year");
		videoname=node.getElementsByTagName("video")[0].childNodes[0].nodeValue;		//Just in case XPath has multiple results, take the first one
	});
	//Counts the length of XPath Result.
	function getNodes(iterator) {
		var nodes = [],
			next = iterator.iterateNext();
		nodes.push(next);
		return nodes;
	}
}


function load_xml_doc(year) {
	if (isNaN(year)){
		video.poster("ctv_images/videoblankl.jpg")
	} else if(year==active_year) {
		video.poster("ctv_images/videoblankl.jpg")
	} else {
		if (xml_load == true) {
			video.poster('ctv_images/'+String(year).substr(-2)+'arch.jpg')
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

//Func: Parses xml.responseXML into the playlist HTML table
function xml2table(xml) {
	var i;
	var xmlDoc = xml.responseXML;
	var tableTMP="";
	var x =xmlDoc.getElementsByTagName("ep")
	//For each *ep* element in the "response.XML", extract the relevent data
	for (i = 0; i <x.length; i++) {
		var video_table = x[i].getElementsByTagName("video")[0].childNodes[0].nodeValue
		var title_table = x[i].getElementsByTagName("title")[0].childNodes[0].nodeValue
		var aired_table = x[i].getElementsByTagName("aired")[0].childNodes[0].nodeValue
		var featu_table = x[i].getElementsByTagName("ft")[0].childNodes[0].nodeValue

		//Takes the extracted relevent data and shoves it in "tableTMP"
		tableTMP += "<tr><td href=\"#\"  id=\"" +
	video_table +
	"\" onclick=set_video(this.id);><a class=\"download\" href=\"/episodes/" +
	video_table +
	"\"download>("+
	//TODO: handle if file has no extention
	video_table.split('.').pop() +
	")</a>"+
	title_table  +
	"<span> Aired: " +
	aired_table +
	"<br>Featuring: " +
	featu_table +
	"</span></td></tr>";
	}
	//Set the playlist table equal to the "tableTMP"
	document.getElementById("playlist").innerHTML = tableTMP;
}

//Func: Turn URL Parameters into an array for JS usage. Ex: video.php?episode=400&autoplay
function get_url_params(){ 
	if (location.search) location.search.substr(1).split("&").forEach(function(item) {
		var s = item.split("="),
			k = s[0],
			v = s[1] && decodeURIComponent(s[1]);
		(URLParams[k] = URLParams[k] || []).push(v)
	})
}


</script>
<!--TODO: Fix functionaity in firefox-->
<div style="margin-top:1rem; display:inline-block;">
  <div class="yearbox">
	<a onclick="load_xml_doc(active_year);">
	<img src="ctv_images/arch.png" data-rjs="3">
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
