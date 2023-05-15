<?php
require 'C:\OSPanel\domains\lr4ud\php\connect.php';
$curs = filter_var(trim($_POST['curs']),FILTER_SANITIZE_STRING);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$user=$_COOKIE['user'];
$result = $mysql->query("SELECT * FROM `curs` WHERE `number_curs` = '$curs'");
$row = $result->fetch_row();
if ($row[0]==0){
    echo "На данный момент вы не можете записаться на этот курс";
    exit();
}
$mysql->query("INSERT INTO `stud_curs` (`mail_stud`,`number_curs`)  VALUES ('$user','$curs')");
$mysql->close();
header('Location: /html/Employee.php');
?>