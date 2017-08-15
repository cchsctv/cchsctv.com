<?php
header( 'Content-type: text/xml' );
echo '<?xml version="1.0" encoding="UTF-8"?>';
$xml=simplexml_load_file("video.xml") or die("Error: Cannot create object");
if (!isset($_GET['number_videos'])) {
  $number_videos = 0;
} else {
  $number_videos = $_GET['number_videos'];
  $number_videos = $number_videos - 1;
}
echo '<eps>';
for ($i = 0; $i <= $number_videos; $i++){
  echo '<ep year="'.$xml->ep[$i]['year'];
  $special = $xml->ep[$i]['special'];
  if (!empty($special)) {
    echo '" special="'.$special;
  }
  echo '">';
  echo '<title>'.$xml->ep[$i]->title.'</title>';
  echo '<aired>'.$xml->ep[$i]->aired.'</aired>';
  echo '<ft>'.$xml->ep[$i]->ft.'</ft>';
  echo '<video>'.$xml->ep[$i]->video.'</video>';
  echo '</ep>';
}
echo '</eps>';
?>
