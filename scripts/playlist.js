
const video = videojs("video"); 
const table = document.getElementById("playlist");
const xmlhttp = new XMLHttpRequest();
let videoload = false;
let xml_load = false;
let url_ops = false;
let year = false;
let URLParams = {};
let active_video;
let videoname;
let epnum;



//Logic, Decides what video to play next on video end
video.on("ended", function() {
	//If the next video exists in the table, set the "epnum" to it
	if(document.getElementsByClassName("hover")[0].parentElement.nextElementSibling){
		videoname = document.getElementsByClassName("hover")[0].parentElement.nextElementSibling.childNodes[0].id;
	} 
	//If there are URL operators, set "epnum" to... results in loop
	else if (URLParams.special) {
		videoname = table.rows[0].cells[0].id;
	} 
	//If the last episode is finished, redirect to musicals
	else if (active_video=="117"){
		window.location.href = "video.php?special=musical&autoplay";
	} 
	//If no other conditions met, go to the previous year
	else {
		epnum2file();							//Get the filename, sets "epnum" and "year" of ended video
		load_xml_doc(year*1-1).then(function() {					//Go to the previous year
		table.rows[0].cells[0].onclick();				//Set to the top episode
		});
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
	if (URLParams.episode){
		epnum=URLParams.episode[0];		//Value from the first in array, just in case multiple were specified
		get_url_params();
		videoname = table.querySelectorAll("[id*='"+epnum+"']")[0].id;
		videoload = false;
		set_video(videoname);
	}
	//If no year or episode was specified in URL Params...
	else {
		videoload = false;
		table.rows[0].cells[0].onclick();
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
	//Scroll to the top, smoothly
	window.scroll({
		top: 0, 
		behavior: "smooth" 
	});
	const hover = document.getElementsByClassName("hover");		//Gets the current "hover" element
	
	//Removes the "hover" from the "hover" element
	while (hover.length){
		hover[0].classList.remove("hover");
	}
	
	//Point the player to the video
	let vurl = "/episodes/"+videoname;
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
		change_url("","video.php?"+url_ops+"\&episode="+videoname);
	} else {
		change_url("","video.php?episode="+videoname);
	}
	active_video = videoname;
}

//Func: It changes the URL.
function change_url(title, url) {
	var obj = { Title: title, Url: url };
	history.replaceState(obj, obj.Title, obj.Url);
}

function load_xml_doc(year) {
	if (isNaN(year)){
		video.poster("ctv_images/videoblankl.jpg");
	} else if(year==active_year) {
		video.poster("ctv_images/videoblankl.jpg");
	} else {
		if (xml_load === true) {
			video.poster("ctv_images/"+String(year).substr(-2)+"arch.jpg");
		}
	}
	return new Promise(function(resolve){
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				xml2table(xmlhttp);
				resolve("done!");
				videoload = false;
				table.rows[0].cells[0].onclick();
			}
		};
		xmlhttp.open("GET", "video_fetch.php?year="+year+"", true);
		xmlhttp.send();
		xml_load = true;
	});
}

//Func: Parses xml.responseXML into the playlist HTML table
function xml2table(xml) {
	let tableTMP = "";
	const response_eps = xml.responseXML.getElementsByTagName("ep");
	//For each *ep* element in the "response.XML", extract the relevent data
	for (const each of response_eps) {
		const video_table = each.getElementsByTagName("video")[0].childNodes[0].nodeValue;
		const title_table = each.getElementsByTagName("title")[0].childNodes[0].nodeValue;
		const aired_table = each.getElementsByTagName("aired")[0].childNodes[0].nodeValue;
		const featu_table = each.getElementsByTagName("ft")[0].childNodes[0].nodeValue;

		//Takes the extracted relevent data and shoves it in "tableTMP"
		tableTMP +=
			"<tr><td href=\"#\"  id=\"" +
			video_table +
			"\" onclick=set_video(this.id);><a class=\"download\" href=\"/episodes/" +
			video_table +
			"\"download>("+
			//TODO: handle if file has no extention
			video_table.split(".").pop() +
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
		(URLParams[k] = URLParams[k] || []).push(v);
	});
}