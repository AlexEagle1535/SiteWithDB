<?php
$fio = filter_var(trim($_POST['fio']),FILTER_SANITIZE_STRING);
$select1 = filter_var(trim($_POST['select-1']),FILTER_SANITIZE_STRING);
$mail = filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysql = new mysqli('localhost','root','','lr4');
if ($mysql == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    exit();
}
switch($select1){
    case 'prepod':{
        $result=$mysql->query("SELECT count(*) FROM `prepod` WHERE `mail`='$mail'");
        break;
    }
    case 'stud':{
        $result=$mysql->query("SELECT count(*) FROM `student` WHERE `mail`='$mail'");
        break;
    }
}
$row = $result->fetch_row();
$count = $row[0];
if ($count != 0){
    print("Введенная почта уже занята");
    $mysql->close();
} else{
    if ($select1 == 'prepod'){
        $mysql->query("INSERT INTO `prepod` (`fio`,`mail`,`password`) VALUES ('$fio','$mail','$pass')");
    }
    elseif ($select1 == 'stud')
    {
        $mysql->query("INSERT INTO `student` (`fio`,`mail`,`password`) VALUES ('$fio','$mail','$pass')");
    }
    $mysql->close();
    header('Location: /html/LoginPage.html');
}
?>