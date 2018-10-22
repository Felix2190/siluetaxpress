<?php
session_start();
if (isset($_POST['url'])){
    $_SESSION['url']=$_POST['url'];
    echo $_SESSION['url'];
}else {
    header("Location: ../login.php");
}
?>