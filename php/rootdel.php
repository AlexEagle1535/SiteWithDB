<?php
require 'C:\OSPanel\domains\lr4ud\php\connect.php';
$mail = filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysql->query("DELETE FROM `prepod` WHERE `mail` = '$mail'");
$mysql->close();
header('Location: /html/root.php');
?>