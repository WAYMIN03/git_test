<?php
if (!empty($_POST)) {
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);

$errorMessage = "";
// 後端驗證：檢查 name 是否符合 4~20 個英數字
if (preg_match("/^[a-zA-Z0-9]{4,20}$/", $name) == 0) {
    $errorMessage .= "姓名必須是4~20個英數字<br>";
}

// 驗證失敗則中止執行，不寫入資料庫
if (!empty($errorMessage)) {
    echo $errorMessage;
    exit;
}
try {
$pdo = new PDO('sqlite:test.db');
//讓他會跳exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
id INTEGER PRIMARY KEY AUTOINCREMENT,
name TEXT NOT NULL,
email TEXT NOT NULL UNIQUE
)");
$stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
$stmt->execute([
':name' => $name,
':email' => $email
]);
} catch (PDOException $e) {
if ($e->getCode() == '23000') {
echo "資料重複，insert 失敗<br><br>";
} else {
echo "錯誤：" . $e->getMessage(), "<br><br>";
}
}
echo "你輸入的個資：";
echo "姓名：$name<br><br>";
echo "電子信箱：$email<br><br>";
} else {
echo "沒東西ㄛ";
}