<?php
require 'C:\OSPanel\domains\lr4ud\php\connect.php';
$zanyat_type = filter_var(trim($_POST['zanyat_type']),FILTER_SANITIZE_STRING);
$number_aud = filter_var(trim($_POST['number_aud']),FILTER_SANITIZE_STRING);
$date = filter_var(trim($_POST['date']),FILTER_SANITIZE_STRING);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$user=$_COOKIE['user'];
$result = $mysql->query("SELECT `number_curs` FROM `curs` WHERE `mail_prepod`='$user'");
$row = $result->fetch_assoc();
$curs = $row['number_curs'];
$mysql->query("INSERT INTO `zanyat` (`zanyat_type` ,`number_aud`, `number_curs`, `date`)  VALUES ('$zanyat_type','$number_aud','$curs','$date')");
$mysql->close();
header('Location: /html/Owner.php');
?>