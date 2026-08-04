<?php
if (!empty($_POST)) {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $userId = htmlspecialchars($_POST["userid"]);
    $errorMessage = "";
    if (preg_match("/^[a-zA-Z0-9]{4,19}$/", $userId) == 0) {
        $errorMessage .= "UserId 必須是4~20個英數字\n";
    }
    if (!empty($errorMessage)) {
        echo $errorMessage;
    } else {
        echo "你輸入的個資：";
        echo "姓名：$name<br><br>";
        echo "電子信箱：$email<br><br>";
        echo "USERID：$userId<br><br>";
    }
} else {
    echo "沒東西ㄛ";
}
