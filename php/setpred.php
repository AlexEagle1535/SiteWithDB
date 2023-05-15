<?php
require 'C:\OSPanel\domains\lr4ud\php\connect.php';
$curs = filter_var(trim($_POST['curs']),FILTER_SANITIZE_STRING);
$curs_info = filter_var(trim($_POST['curs_info']),FILTER_SANITIZE_STRING);
$curs_name = filter_var(trim($_POST['curs_name']),FILTER_SANITIZE_STRING);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$user=$_COOKIE['user'];
$mysql->query("INSERT INTO `curs` (`mail_prepod` ,`info_curs`, `number_curs`, `name_curs`)  VALUES ('$user','$curs_info','$curs','$curs_name')");
$mysql->close();
header('Location: /html/Owner.php');
?>