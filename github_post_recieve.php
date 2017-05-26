<?php

// Use in the "Post-Receive URLs" section of your GitHub repo.

if ( $_POST['payload'] ) {
  /*shell_exec( 'cd /home/ctvserver/public_html && git reset --hard HEAD && git pull' ); */
  shell_exec( 'cd /home/ctvserver/public_html && git pull' );
}
?>hi
