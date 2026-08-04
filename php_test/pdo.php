<?php
$allUsers = [];
try {
    $pdo = new PDO('sqlite:test.db');
    
    //讓他會跳error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE
    )");
    $stmt = $pdo->prepare("INSERT OR IGNORE INTO users (name, email) VALUES (:name, :email)");
    $stmt->execute([
        ':name' => 'Alice',
        ':email' => 'alice@example.com'
    ]);
    $allUsers = $pdo->query("SELECT * FROM users");
} catch (PDOException $e) {
    echo "錯誤：" . $e->getMessage();
}
?>
<html>
<body>
    All Users：
    <ul>
        <?php
        foreach ($allUsers as $user) {
            $id = $user["id"];
            $name = $user["name"];
            $email = $user["email"];
            echo "<li>ID: {$id}, Name: {$name}, Email: {$email}</li>";
        }
        ?>
    </ul>
</body>
</html>
