<?php
$dsn='sqlite:quiz_app.db';

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Veritabanı bağlantısı başarısız: ' . $e->getMessage();
}
?>