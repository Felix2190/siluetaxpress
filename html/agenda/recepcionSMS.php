<?php
$alias .= $_POST[’alias’];
$mensaje .= $_POST[’text’];
$telefono .= $_POST[’telnum’];
$keyword .= $_POST[’keyword’];
$shortnum .= $_POST[’shortnum’];

$respuesta="OK";
header("Content-Type: text/plain; charset=UTF-8");
echo $respuesta;
?>