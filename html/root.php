<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Система управления "Личный кабинет"</title>
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="../styles/root.css">
    <link rel="stylesheet" href="../styles/Navbar.css">
</head>

<body>
    <?php
    if ($_COOKIE['user']!='root'){
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
            <li><a href="/php/exitroot.php">Выйти из аккаунта</a></li>
        </ul>
    </nav>
    <div class='flex-container'>
        <div class='taskBar-container' align="center">
            <div >
                <h2>Администратор</h2>
                <div class='table'>
                    <h3>Преподаватели</h3>
                    <?php
                    require 'C:\OSPanel\domains\lr4ud\php\connect.php';
                        echo "
                        <table>
                            <tbody>
                                <tr>
                                    <td>ФИО</td>
                                    <td>mail</td>
                                    <td>Пароль</td>
                                </tr>
                                ";
                        $result = $mysql->query("SELECT * FROM `prepod`");
                        while ($row=$result->fetch_array()) { // выводим данные

                        echo "<tr>\n
                        <td>".$row["fio"]."</td>"."\n"."<td>"."".$row["mail"]." </td>"."\n"."<td>".$row["password"]."</td>"."\n"."</tr>"."\n
                        ";
                        }
                        echo '
                            </tbody>
                        </table>
                        <form id="form" action="/php/rootdel.php" method="post">
                        <div class="txt_field">
                            <input type="text" name="mail" required></input>
                            <span></span>
                            <label>mail</label>
                        </div>
                        <input type="submit" value="Удалить"></input>
                        </form>
                        <h3>Студенты</h3>
                        <table>
                        <tbody>
                            <tr>
                                <td>ФИО</td>
                                <td>mail</td>
                                <td>Пароль</td>
                            </tr>
                        ';
                        $result = $mysql->query("SELECT * FROM `student`");
                        while ($row=$result->fetch_array()) {
                            echo "<tr>\n
                            <td>".$row["fio"]."</td>"."\n"."<td>"."".$row["mail"]." </td>"."\n"."<td>".$row["password"]."</td>"."\n"."</tr>"."\n
                            ";
                        }
                        echo '
                            </tbody>
                        </table>
                        <form id="form" action="/php/.php" method="post">
                        <div class="txt_field">
                            <input type="text" name="mail" required></input>
                            <span></span>
                            <label>mail</label>
                        </div>
                        <input type="submit" value="Удалить"></input>
                        </form>
                        ';
                    ?>

                </div>
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