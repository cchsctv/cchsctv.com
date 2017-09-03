<?php
header( 'Content-type: text/xml' );
echo '<?xml version="1.0" encoding="UTF-8"?>';
$xml=simplexml_load_file("video.xml") or die("Error: Cannot create object");

$query  = explode('&', $_SERVER['QUERY_STRING']);
$params = array();

foreach( $query as $param ){
  list($name, $value) = explode('=', $param, 2);
  $params[urldecode($name)][] = urldecode($value);
}

$number_videos = 1;

if (isset($_GET['year'])) {
  $year = implode("\" or @year=\"",$params['year']);
  $years = '[@year="'.$year.'"]';
  $number_videos = "na";
}
if (isset($_GET['special'])) {
  $special = implode("\" or @special=\"",$params['special']);
  $specials = '[@special="'.$special.'"]';
  $number_videos = "na";
}
if (isset($_GET['number_videos'])) {
  $number_videos = $_GET['number_videos'];
}

$attribute = "";
if (isset($years    )){$attribute .= $years;}
if (isset($specials )){$attribute .= $specials;}
if (empty($attribute)){$attribute  = "na";}

echo '<eps>';
xml_out($xml,$attribute,$number_videos);
echo '</eps>';

function xml_out($xml,$attribute,$number_videos) {
  if ($attribute != "na"){
    $xml = $xml->xpath('/eps/ep'.$attribute);
    $count = count($xml);
  } else {
    $xml = $xml->xpath('/eps/ep');
    $count = $number_videos;
  }

  for ($i = 0; $i <= $count-1; $i++){
    echo '<ep year="'.$xml[$i]['year'];
    $special = $xml[$i]['special'];
    if (!empty($special)) {
      echo '" special="'.$special;
    }
    echo '">';
    echo '<title>'.$xml[$i]->title.'</title>';
    echo '<aired>'.$xml[$i]->aired.'</aired>';
    echo '<ft>'.$xml[$i]->ft.'</ft>';
    echo '<video>'.$xml[$i]->video.'</video>';
    echo '</ep>';
  }
}
?>
