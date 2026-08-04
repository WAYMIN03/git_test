<?php
if (!empty($_POST)) {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    echo "你輸入的個資：";
    echo "姓名：$name<br><br>";
    echo "電子信箱：$email<br><br>";
} else {
    echo "沒東西ㄛ";
}
