<?php
include '../layout/header.php';
include './db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($username && $password) {
        try {
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->execute([':username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
    
                    if ($user['role'] === 'admin') {
                        echo "<div class='success-message'>Hoş Geldiniz, Yönetici!, Yönlendiriliyorsunuz...</div>";
                        header('Refresh: 2; url=./admin_dashboard.php');  
                    } else {
                        echo "<div class='success-message'>Hoş Geldiniz, $username, Yönlendiriliyorsunuz...</div>";
                        header('Refresh: 2; url=./student_dashboard.php');
                    }
                } else {
                    echo "<div class='error-message'>Kullanıcı adı veya şifre hatalı!</div>";
                }
            }
        } catch (PDOException $e) {
            echo "<div class='error-message'>Hata: " . $e->getMessage() . "</div>";
        }
        
    } else {
        echo "<div class='error-message'>Kullanıcı adı ve şifre boş olamaz!</div>";
    }

}
?>

<form method="post" action="login.php">
    <label for="username">Kullanıcı Adı:</label>
    <input type="text" name="username" required><br>

    <label for="password">Şifre:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Giriş Yap</button>
</form>

<?php include '../layout/footer.php'; ?>