<?php
/*
///##### STOP! #####\\\
DO NOT EDIT THIS FILE DIRECTLY
This file is mamanged by GIT
Contribute at https://github.com/cchsctv/cchsctv.com/
*/
$page_title = "Cast";
require 'header.php';


?>
<style type="text/css">
p.style{
	font-family: HelveticaNeue-Light, Helvetica, Arial, sans-serif;
	font-size: 1.2em;
	color:white;
	margin:0px;
	letter-spacing:1px;
}
p.head{
	font-family: HelveticaNeue-Light, Helvetica, Arial, sans-serif;
	font-size: 1.5em;
	color:white;
	margin:8px 0;
	font-weight: bold;
	letter-spacing:2px;
  width:100%;
}
.content_container {background-color: #777777 !important}
.officer_container, .staff_container {
	border:5px solid #777777;
	border-right:none;
	border-bottom:none;
	height: auto;
	float: left;
	justify-content: space-between;
}
.staff_container .name {background-color:rgba(0, 0, 0, 0.8);}
.officer_container .name {background-color:rgba(195, 14, 14, 0.8);}
.name {
  position:absolute;
  background-color:rgba(0, 0, 0, 0.8);
  transform:translateY(calc(-.9em - 50%));
  transform:translateY(-100%);
}
.name p{
	font-family: HelveticaNeue-Light, Helvetica, Arial, sans-serif;
	font-size: .9em;
	color:white;
	margin:5px;
	font-weight: bold;
	text-shadow: -2px 2px #000000;
  text-align:left;
}
.director {
  position:absolute;
  transform:translateY(calc(-0.15em - 200%));
  background-color:rgba(195, 14, 14, 0.8);
}
p.sub{
	font-family: HelveticaNeue-Light, Helvetica, Arial, sans-serif;
	font-size: .75em;
	color:white;
	margin:5px;
  font-weight: bold;
	letter-spacing:1px;
}
p.pichardo{
	font-family: HelveticaNeue-Light, Helvetica, Arial, sans-serif;
	font-size: .9em;
	color:white;
	margin:5px;
	line-height:150%;
	letter-spacing:1px;
}
.bardivider {
  width: 100%;
  background-color: #c30e0e;
  float:left;
  text-align:center;
  border: solid black;
	border-width: 0;
  margin-top: 5px;
	border-top-width: 10px;
}
.officer_container {
  width: calc(calc(calc(100% - 5px) * 0.3333) - 5px);
	background-color:black;
}
.officer_container img {
  width: 100%;
  height: auto;
  vertical-align: middle;
}
.officer_inner {
  background-color:#777777;
  height: auto;
  float: left;
  justify-content: space-between;
}
.staff_container {
  width: calc(calc(calc(100% - 5px) * 0.25) - 5px);
}
.staff_container img {
  width: 100%;
  height: auto;
  vertical-align: middle;
}
.chardo_bio {
  width: calc(calc(calc(100% - 5px) * 0.5) - 5px);
  width: calc(100% - 10px);
  width: 100%;
  background-color:#505050;
  float:left;
  text-align:center;
  background-color:black;
  padding-top: 10px;
}
@media only screen and (max-width: 720px) {
  .topnav a:not(:nth-child(3)) {
    display: none;
  }
  .topnav a:nth-child(3) {
    display: inherit;
  }
  .bardivider{
		border-width: 10px 0;
  }
}
@media only screen and (max-width: 680px) {
  .officer_container {
    width: calc(calc(calc(100% - 5px) * 0.5) - 5px);
  }
  .staff_container {
    width: calc(calc(calc(100% - 5px) * 0.33) - 5px);
  }
}
@media only screen and (max-width: 580px) {
  .staff_container {
    width: calc(calc(calc(100% - 5px) * 0.5) - 5px);
  }
}
@media only screen and (max-width: 480px) {
  .officer_container {
    width:  50%;
    border: none;
  }
  .staff_container {
    width:  50%;
    border: none;
  }
  .bardivider {
    margin: 0;
  }
}
@media only screen and (max-width: 350px) {
  div .content_container {
    border: none;
  }
}
}
</style>
<?php
include 'topnav.php';
?>
<!-- PAGE BEGIN-->

<div style="clear:both"></div>

<div class="edge2edge bardivider" style="margin:0;border-top:none"><p class="head">2018-2019 OFFICERS</p></div>

<!-- BEGIN OFFICERS -->
<!-- OFFICER PICTURES MUST HAVE 230x170 ASPECT RATIO -->
<div class="officer_container">
  <img src="ctv_images/staff/Gabby.png" data-rjs="2">
    <div class="name">
  <p>Gabriela Carbone</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">President</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/Alexa.png" data-rjs="2">
    <div class="name">
  <p>Alexa Pichardo</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Vice President</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/Ethan.png" data-rjs="2">
    <div class="name">
  <p>Ethan Silverman</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Asst. Vice President</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/Melissa.png" data-rjs="2">
    <div class="name">
  <p>Melissa Luque</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Secretary</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/Nicole.png" data-rjs="2">
    <div class="name">
  <p>Nicole Nelson</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Treasurer</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/AndrewRothschild.jpg" data-rjs="2">
    <div class="name">
  <p>Andrew Rothschild</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Historian/TEST</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/Schwam.png" data-rjs="2">
    <div class="name">
  <p>Matthew Schwam</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Business Manager</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/ChrisWill.png" data-rjs="2">
    <div class="name">
  <p>Chris Will</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Equipment Manager</p>
</div>
</div>
<div class="officer_container">
  <img src="ctv_images/staff/Robert.png" data-rjs="2">
    <div class="name">
  <p>Robert Hidalgo</p>
    </div>
  <div style="position:relative;">
  <p class="sub" style="position:relative; text-align:left;">Operations Manager</p>
</div>
</div>

<!-- END OFFICERS -->

<div class="edge2edge bardivider"><p class="head">2018-2019 STAFF</p></div>

<!-- BEGIN STAFF -->
<!-- STAFF PICTURES MUST HAVE SQUARE (170x170) ASPECT RATIO -->
<div class="staff_container">
  <img src="ctv_images/staff/Emily.png" data-rjs="2">
  <div class="name">
  <p>Emily Aaron</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Reese.png" data-rjs="2">
  <div class="name">
  <p>Reese Abrahamoff</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Imani.png" data-rjs="2">
  <div class="name">
  <p>Imani Armand</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Franchesca.png" data-rjs="2">
  <div class="name">
  <p>Francesca Duarte</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Jake.png" data-rjs="2">
	<div class="director"><p class="sub">Sports Director</p></div>
  <div class="name">
  <p>Jake Glantz</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Lucas.png" data-rjs="2">
  <div class="name">
  <p>Lucas Hemingway</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Kayla.png" data-rjs="2">
  <div class="name">
  <p>Kayla Kissel</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Lefty.png" data-rjs="2">
  <div class="name">
  <p>Ryan Lewis</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Isabella.png" data-rjs="2">
  <div class="name">
  <p>Isabella Marcon</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/FelipeLopez.jpg" data-rjs="2">
  <div class="name">
  <p>Verónica Martínez</p>
</div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Sofia.png" data-rjs="2">
  <div class="name">
  <p>Sofia Mendez</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Gio.png" data-rjs="2">
  <div class="name">
  <p>Giovanni Papini</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Mike.png" data-rjs="2">
  <div class="director"><p class="sub">Entertainment Director</p></div>
  <div class="name">
  <p>Michael Potes</p>
  </div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/Righty.png" data-rjs="2">
  <div class="name">
  <p>Ryan Rothschild</p></div>
</div>
<!--
<div class="staff_container">
  <img src="ctv_images/staff/MarioSculac.jpg" data-rjs="2">
  <div class="name">
  <p>Mario Sculac</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/EthanSilverman.jpg" data-rjs="2">
  <div class="name">
  <p>Ethan Silverman</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/IsabellaTocci.jpg" data-rjs="2">
	<div class="director"><p class="sub">News Director</p></div>
  <div class="name">
  <p>Isabella Tocci</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/ChristopherWill.jpg" data-rjs="2">
  <div class="name">
  <p>Christopher Will</p></div>
</div>
-->
<!--
<div class="staff_container">
  <img src="ctv_images/staff/daniellesiso.jpg" data-rjs="2">
  <div class="name">
  <p>Danielle Siso</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/rebeccasmitherman.jpg" data-rjs="2">
  <div class="name">
  <p>Rebecca Smitherman</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/douglasweimann.jpg" data-rjs="2">
  <div class="name">
  <p>Douglas Weimann</p></div>
</div>
<div class="staff_container">
  <img src="ctv_images/staff/annavillalonga.jpg" data-rjs="2">
  <div class="director"><p class="sub">Sports Director</p></div>
  <div class="name">
  <p>Anna Villalonga</p>

  </div>
</div>
-->
<!-- END STAFF -->

<!-- BLANK CAST BOX
<div class="staff_container">
  <img src="ctv_images/staff/nophoto.jpg" data-rjs="2">
  <div class="name">
  <p>Anna Villalonga-Diez</p></div></div>
-->



<div class="edge2edge bardivider" style="border-bottom:none"><p class="head">ADVISOR</p></div>
<!-- BEGIN ADVISOR -->
<!-- ALL PICTURES MUST BE 170x170 -->
<div class="chardo_bio">
  <div class="officer_container" style="border: 0px; padding-right:10px; background-color:black">
    <img src="ctv_images/staff/pichardo.jpg">
    <div class="name">
    <p>Mr. Pichardo</p></div>
  </div>
  <p class="pichardo" style="text-align:justify; text-indent:50px; color:white">
    Since joining CTV in 2005, <b>Alfredo Pichardo</b> has worked to bring his real world
    experience into the classroom. Having worked as a Coordinating Producer, Technical Operations Manager,
    and Studio Camera Operator for networks such as Univision, Telemundo, NBC, CBS, and MTV, Mr. Pichardo is
    able to prepare CTV students for careers in television far beyond what can be taught from a textbook.
    He has a wife, three kids, and a CTV family that wouldn’t be the same without him.
  </p><p class="pichardo" style="text-align:center;">Email:
    <a href="mailto:apichardo@cchsctv.com">apichardo@cchsctv.com</a>&nbsp;&nbsp;&nbsp;Resume:
    <a href="pdf/pichardoresume.pdf" target="_blank">(click here)</a>
  </p>
</div>
<!-- END ADVISOR -->




<div style="clear:both"></div>

<?php require 'footer.php' ?>
