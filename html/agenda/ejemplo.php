<?php
$time = date("G:i:s");
$entry = "Informaci�n guardada a las $time.\n";
$file = "/home/zs5xw0qfuut5/public_html/test.cron.txt";
$open = fopen($file,"a");

if ( $open ) {
    fwrite($open,$entry);
    fclose($open);
}

?>