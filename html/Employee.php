<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Система управления "Личный кабинет"</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/Employee.css">
    <link rel="stylesheet" href="../styles/Navbar.css">
</head>

<body>
    <?php
    require 'C:\OSPanel\domains\lr4ud\php\connect.php';
    $user=$_COOKIE['user'];
    $result = $mysql->query("SELECT count(*) from `student` WHERE `mail`='$user'");
    $check = $result->fetch_assoc();
    $mysql->close();
    if ($_COOKIE['user']==''||count($check)==0){
        header('Location: LoginPage.html');
    }
    ?>
    <input type="checkbox" id="drawer-toggle" name="drawer-toggle" />
    <label for="drawer-toggle" id="drawer-toggle-label"></label>
    <header>
        <h3>СИСТЕМА УПРАВЛЕНИЯ "ЛИЧНЫЙ КАБИНЕТ"</h3>
        <a href="Employee.php">
            <img class='icon' alt="icon" src="../assets/Main_icon.png"></img>
        </a>
    </header>
    <nav id="drawer">
        <ul>
            <li><a href="/php/exit.php">Выйти из аккаунта</a></li>
        </ul>
    </nav>
    <div class='flex-container'>
        <div class='profile-container'>
            <div class='profile-data'>
                <p>
                <?php
                    require 'C:\OSPanel\domains\lr4ud\php\connect.php';
                    $user=$_COOKIE['user'];
                    $result = $mysql->query("SELECT `fio` from `student` WHERE `mail`='$user'");
                    $row = $result->fetch_array();
                    print($row['fio']);
                    $mysql->close();
                ?>
                </p>
                <div class='underline'></div>
                <p>Студент</p>
                <div class='underline'></div>
                <p>СевГУ</p>
            </div>
        </div>
        <div class='taskBar-container' align="center">
            
                <h2>Расписание</h2> <br> <br>
                <div class='table'>
                    <?php
                    require 'C:\OSPanel\domains\lr4ud\php\connect.php';
                    $user=$_COOKIE['user'];
                    $result = $mysql->query("SELECT `number_curs` from `stud_curs` WHERE `mail_stud`='$user'");
                    $row = $result->fetch_row();
                    if ($row[0] == 0){
                        echo 
                        '<h3>Выберите курс</h3>
                        <form id="form" action="/php/setcurs.php" method="post" id="form">
                            <select class="list" name="curs">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <input type="submit" value="Отправить"></input>
                        </form>';
                    }
                    else {
                        echo "
                        <table>
                            <tbody>
                                <tr>
                                    <td>Дата</td>
                                    <td>Предмет</td>
                                    <td>Преподаватель</td>
                                    <td>Номер аудитории</td>
                                    <td>Тип занятия</td>
                                </tr>
                                ";
                        $result = $mysql->query("SELECT `date`, `fio`,`name_curs`, `number_aud`, `zanyat_type` FROM `stud_curs`, `zanyat`, `curs`, `prepod` 
                        WHERE `mail_stud`='$user' AND `mail_prepod`=`prepod`.`mail` AND `curs`.`number_curs`=`stud_curs`.`number_curs` AND `curs`.`number_curs` = `zanyat`.`number_curs`");
                        while ($row=$result->fetch_array()) { // выводим данные

                        echo "<tr>\n
                        <td>".$row["date"]."</td>"."\n"."<td>"."".$row["name_curs"]." </td>"."\n"."<td>".$row["fio"]."</td>"."\n"."<td>"."
                        ".$row["number_aud"]."</td>"."\n"."<td>"."".$row["zanyat_type"]."</td>"."\n"."</tr>"."\n
                        ";
                        }
                        echo "
                            </tbody>
                        </table>
                        ";
                    }
                    $mysql->close();
                    ?>

                </div>
            
        </div>
    </div>
    <footer>
        <div class="social-icon">
            <a href="https://www.google.ru/"><img src="../assets/icons8-google-50 (1).png" alt="text"></a>
        </div>
        <div class="social-icon">
            <a href="https://vk.company/ru/"><img src="../assets/icons8-вконтакте-50.png" alt="text"></a>
        </div>
        <div class="social-icon">
            <a href="https://telegram.org/"><img src="../assets/icons8-телеграмма-app-50 (1).png" alt="text"></a>
        </div>
    </footer>
</body>

</html>