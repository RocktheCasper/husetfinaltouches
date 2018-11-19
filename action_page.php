<?php
 $fornavn=$_REQUEST['fname'];
 $efternavn=$_REQUEST['lname'];
$gem="$fornavn $efternavn \n";
file_put_contents("test.txt", $gem, FILE_APPEND);
echo "Mange tak, $fornavn $efternavn, nu er du tilmeldt");
?>
