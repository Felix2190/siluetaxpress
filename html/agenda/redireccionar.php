<?php
session_start();
if (isset($_POST['url'])){
    $_SESSION['url']=$_POST['url'];
    echo true;
}else {
    header("Location: ../login.php");
}
?>