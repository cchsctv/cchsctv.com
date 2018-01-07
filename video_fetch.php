<?php
$xml = $xml ?? simplexml_load_file("video.xml") or die("Error: Cannot create object");

//Parse URL Params, if any
if(!empty($_SERVER['QUERY_STRING'])) {
  $query  = explode('&', $_SERVER['QUERY_STRING']);
  $params = array();
  foreach( $query as $param ){
    list($name, $value) = explode('=', $param, 2);
    $params[urldecode($name)][] = urldecode($value);
  }
}

//Default amount of videos to return
$number_videos = 1;

//How many videos to fetch
if (isset($_GET['number_videos'])) {
  //Fist make sure its a number
  if (is_numeric($_GET['number_videos'])) {
    $number_videos = $_GET['number_videos'];
  }
  //Check if there are that many entries to return
  if (count($xml) < $number_videos){
    $number_videos = count($xml);
  }
}

//?year=....
if (isset($_GET['year'])) {
  $year = implode("\" or @year=\"",$params['year']);
  $years = '[@year="'.$year.'"]';
  $number_videos = false;
}
//?Special= [musical/underclassmen/senior]
//Accepts multiple
if (isset($_GET['special'])) {
  $special = implode("\" or @special=\"",$params['special']);
  $specials = '[@special="'.$special.'"]';
  $number_videos = false;
}

//Takes an episode number to return all episodes from that year
if (isset($_GET['episode'])) {
  $episode = (string)'#'.$_GET['episode'];
  $episode = $xml->xpath('/*/ep[title[contains(.,'."\"".$episode."\"".')]]');
  $year = $episode[0]['year'];
  $years = '[@year="'.$year.'"]';
  $number_videos = false;
}

//Assemble XPath 
$attributes = "";
if (isset($years    )){$attributes .= $years;}
if (isset($specials )){$attributes .= $specials;}
if (empty($attributes)){$attributes  = false;}


function xml_trim($xml,$attributes) {
  //If there is an attribue, add to filter
  if ($attributes === false){
    $xml = $xml->xpath('/eps/ep');
  } else {
    $xml = $xml->xpath('/eps/ep'.$attributes);
  }
  return $xml;
}

function xml_print($xml, $number_videos){
  //If a number of videos is specified, use it
  if ($number_videos === false || $number_videos === '0') {
    $count = count($xml);
  } else {
    $count = $number_videos;
  }
  
  //Interate through filtered xml to form valid xml
  for ($i = 0; $i <= $count-1; $i++){
    $content = "";
    $content .= '<ep year="'.$xml[$i]['year'];
    $special = $xml[$i]['special'];
    if (!empty($special)) {
      $content .= '" special="'.$special;
    }
    $content .= '">';
    $content .= '<title>'.$xml[$i]->title.'</title>';
    $content .= '<aired>'.$xml[$i]->aired.'</aired>';
    $content .= '<ft>'.$xml[$i]->ft.'</ft>';
    $content .= '<video>'.$xml[$i]->video.'</video>';
    $content .= '</ep>';
    echo str_replace("&","&amp;", $content);
  }
}
if(!isset($no_print)){
  header( 'Content-type: text/xml' );
  echo '<?xml version="1.0" encoding="UTF-8"?>';
  echo '<eps>';

  $xml = xml_trim($xml,$attributes);

  xml_print($xml, $number_videos);
  echo '</eps>';
}
?>