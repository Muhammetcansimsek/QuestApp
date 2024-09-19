<?php
include '../layout/header.php';
include './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    if ($username && $password) {
        try {
            $checkQuery = "SELECT COUNT(*) FROM users WHERE username = :username";
            $checkStmt = $pdo->prepare($checkQuery);
            $checkStmt->execute([
                ':username' => $username
            ]);
            $userExists = $checkStmt->fetchColumn(PDO::FETCH_ASSOC);

            if($userExists) {
                echo "<div class='error-message'>Bu kullanıcı adı zaten alınmış.</div>";
            } else {

                $query = "INSERT INTO users (username, password, role) VALUES (:username, :password, 'student')";
                $stmt = $pdo->prepare($query);
                $stmt->execute ([
                    ':username' => $username,
                    ':password' => $hashed_password
                ]);
                echo "<div class='success-message'>Kayıt Başarılı!</div>";
                header('Refresh: 2; URL=login.php');
            }

        } catch (PDOException $e) {
            echo "div class='error-message'>Kayıt sırasında bir hata oluştu: " . $e->getMessage() . "</div>";
        }
        
    } else {
        echo "<div class='error-message'>'Lütfen tüm alanları doldurun.</div>";
    }
}
?>

<form method="post" action="register.php">
    <label for="username">Kullanıcı Adı:</label>
    <input type="text" name="username" required><br>

    <label for="password">Şifre:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Kayıt Ol</button>
</form>

<?php include '../layout/footer.php'; ?>