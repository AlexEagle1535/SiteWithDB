<?php
setcookie('user', $user['mail'], time() - 3600, "/");
header('Location: /html/LoginPage.html');
?>