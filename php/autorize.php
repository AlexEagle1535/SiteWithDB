<?php
$mail = filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),FILTER_SANITIZE_STRING);
$select1 = filter_var(trim($_POST['select-1']),FILTER_SANITIZE_STRING);

$mysql = new mysqli('localhost','root','','lr4');

if ($_COOKIE['user']!=''){
    setcookie('user', $user['mail'], time() - 3600, "/");
}

if ($mail == "root@ma.r" && $pass == "root" && $select1 == 'admin'){
    setcookie('user', 'root', time() + 3600, "/");
    header('Location: /html/root.php');
    exit();
}

switch($select1){
    case 'prepod':{
        $result=$mysql->query("SELECT * FROM `prepod` WHERE `mail`='$mail' AND `password`='$pass'");
        break;
    }
    case 'stud':{
        $result=$mysql->query("SELECT * FROM `student` WHERE `mail`='$mail' AND `password`='$pass'");
        break;
    }
}

$check = $result->fetch_assoc();
if (count($check)==0){
    echo "Пользователь не найден";
    $mysql->close();
    header('Location: /html/LoginPage.html');
}
echo "Авторизация прошла успешно";
setcookie('user', $check['mail'], time() + 3600, "/");
$mysql->close();
if ($select1=='prepod'){
    header('Location: /html/Owner.php');
} else header('Location: /html/Employee.php');
?>