<?php
/*
///##### STOP! #####\\\
DO NOT EDIT THIS FILE DIRECTLY
This file is mamanged by GIT
Contribute at https://github.com/cchsctv/cchsctv.com/
*/
?>

</head>
<body>
<style type="text/css">
<?php include 'style.css'; ?>
.button {
    background-color: black;
    border: none;
    margin: 0px !important;
    text-align: center;
    display: inline-block;
    font-size: 16px;
    color: #f2f2f2;
    text-align: center;
    text-decoration: none;
    font-size: 26px;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%;
}
</style>
<div class="main">
  <a class="" href="index.php" style="display:block; line-height:0"> <img src="/admin/admin_images/background_logo.png" data-rjs="3">  </a>
  <div class="content_container">
  <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>
  <div class="topnav" id="myTopnav">
    <a href="/admin/index.php">Admin Home</a>
    <a href="/index.php">Main Site</a>
    <a href="/admin/video.php">Test Video</a>
    <a href="/admin/xml_edit.php">XML Edit</a>
    <a href="javascript:void(0);" style="font-size:30px; margin: 5px; margin-right: 15px;" class="icon" onclick="myFunction()">&#9776;</a>
  </div>
  <?php
  if(isset($_SESSION['admin_auth']))
    echo'
  <form class="topnav" data-ajax="false" method="post">
    <input type="hidden" name="logout" value="true" />
    <a href="#" onclick="document.forms[0].submit();return false;" class="button" type="submit" data-role="button" data-mini="true">Log out</a>
  </form>
  ';