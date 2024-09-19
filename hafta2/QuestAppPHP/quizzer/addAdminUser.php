<?php
include '../layout/header.php';
include './db.php';

function addAdminUser($username, $password) {
    global $pdo;
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $checkQuery = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($checkQuery);
    $stmt->execute(['username' => $username]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo "Bu kullanıcı adı zaten var!";
        return;
    }

    $insertQuery = "INSERT INTO users (username, password, role) VALUES (:username, :password, 'admin')";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute([
        'username' => $username,
        'password' => $hashed_password
    ]);

    if ($stmt) {
        echo "Admin kullanıcı başarıyla eklendi!";
    } else {
        echo "Admin kullanıcı eklenirken bir hata oluştu!";
    }
}

addAdminUser('admin', '$ecr3t@dm1n!');

include '../layout/footer.php';
?>