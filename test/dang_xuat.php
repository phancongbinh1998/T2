<?php
session_start();
unset($_SESSION["nguoi_dung"]);
header("location: " . $_SERVER["HTTP_REFERER"]);
?>