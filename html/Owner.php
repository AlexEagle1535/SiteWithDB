<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Система управления "Личный кабинет"</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/Owner.css">
    <link rel="stylesheet" href="../styles/Navbar.css">
    <link rel="stylesheet" href="../styles/LoginPage.css">
</head>

<script>
    function addItem() {
        var field = document.getElementById("text").value;
        if (field === "") {
            return;
        }
        else {
            var li = document.createElement("li");
            li.innerHTML = field;
            document.getElementById("ol").appendChild(li);
            document.getElementById("text").value = "";
        }
    }
</script>

<body>
    <?php
    require 'C:\OSPanel\domains\lr4ud\php\connect.php';
    $user=$_COOKIE['user'];
    $result = $mysql->query("SELECT count(*) from `prepod` WHERE `mail`='$user'");
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
        <a href="Owner.php">
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
                    $result = $mysql->query("SELECT `fio` from `prepod` WHERE `mail`='$user'");
                    $row = $result->fetch_array();
                    print($row['fio']);
                    $mysql->close();
                ?>
                </p>
                <div class='underline'></div>
                <p>Преподаватель</p>
                <div class='underline'></div>
                <p>СевГУ</p>
                <div class='underline'></div>
            </div>
        </div>
        <div class='taskBar-container'>
            <div class='table'>
                <h2>Расписание</h2>
                <?php
                    require 'C:\OSPanel\domains\lr4ud\php\connect.php';
                    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                    $user=$_COOKIE['user'];
                    $result = $mysql->query("SELECT * from `curs` WHERE `mail_prepod`='$user'");
                    $check = $result->fetch_assoc();
                        if (!$check){
                            echo "<p>Вы не ведете курсов.</p>";
                        }
                        else {
                            echo "
                            <table>
                                <tbody>
                                    <tr>
                                        <td>Дата</td>
                                        <td>Предмет</td>
                                        <td>Номер аудитории</td>
                                        <td>Тип занятия</td>
                                        <td>Количество учеников</td>
                                        <td>Курс</td>
                                    </tr>
                                    ";
                            $result = $mysql->query("SELECT distinct `date`,`name_curs`, `number_aud`,`zanyat_type`, `curs`.`number_curs`, count(ALL) as count 
                            FROM `stud_curs`, `zanyat`,`curs` WHERE `mail_prepod`='$user' AND `curs`.`number_curs`=`zanyat`.`number_curs`");
                            while ($row=$result->fetch_array()) { // выводим данные
    
                            echo "<tr>\n
                            <td>".$row["date"]."</td>"."\n"."<td>"."".$row["name_curs"]." </td>"."\n"."<td>".$row["number_aud"]."</td>"."\n"."<td>"."
                            ".$row["zanyat_type"]."</td>"."<td>"."".$row["count"]."</td>"."\n"."<td>"."".$row["number_curs"]."</td>"."\n"."</tr>"."\n
                            ";
                            }
                            echo "
                                </tbody>
                            </table>
                            ";
                        }
                ?>
            </div>
            <div  class='plan'>
                <?php
                require 'C:\OSPanel\domains\lr4ud\php\connect.php';
                mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
                $user=$_COOKIE['user'];
                $result = $mysql->query("SELECT * from `curs` WHERE `mail_prepod`='$user'");
                $check = $result->fetch_assoc();
                    if (!$check){
                        echo '
                        <h3>Добавить предмет</h3>
                        <form id="form" action="/php/setpred.php" method="post">
                            <div class="txt_field">
                                <input type="text" name="curs_name" required></input>
                                <span></span>
                                <label>Название предмета</label>
                            </div>
                            <label>Номер курса</label>
                            <select class="list" name="curs">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <div class="txt_field">
                                <input type="text" name="curs_info" required></input>
                                <span></span>
                                <label>Описание курса</label>
                            </div>
                            
                                <input type="submit" value="Добавить"></input>
                            
                        </form>
                        ';
                    }
                    else{
                        echo '
                        <h3>Добавить занятие</h3>
                        <form id="form" action="/php/setzan.php" method="post">
                        <div class="txt_field">
                                <input type="text" name="zanyat_type" required></input>
                                <span></span>
                                <label>Тип занятия</label>
                            </div>
                            <div class="txt_field">
                                <input type="text" name="number_aud" required></input>
                                <span></span>
                                <label>Номер аудитории</label>
                            </div>
                            <div class="txt_field">
                                <input type="text" name="date" required></input>
                                <span></span>
                                <label>Дата ГГГГ-ММ-ДД</label>
                            </div>               
                                <input type="submit" value="Добавить"></input>
                            
                        </form>
                        ';

                    }
                ?>
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
    </div>
</body>

</html>