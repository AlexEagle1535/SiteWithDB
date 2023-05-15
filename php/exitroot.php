<?php
setcookie('user', 'root', time() - 3600, "/");
header('Location: /html/LoginPage.html');
?>