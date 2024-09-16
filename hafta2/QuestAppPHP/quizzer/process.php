<?php
include '../layout/header.php';
include './db.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'] ?? null;
    $user_choice = $_POST['choice'] ?? null;

    if(!$question_id || !$user_choice) {
        echo "<h3 style='color:red;'>Lütfen bir seçim yapınız!</h3>";
        header("Refresh:2; url=fetch.php?n=" . $question_id);
        exit();
    }

    $query = "SELECT * FROM questions WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $question_id]);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$question) {
        echo "<h3 style='color:red;'>Soru bulunamadı!</h3>";
        exit();
    }

    $answers = json_decode($question['answers'], true);
    $correct_index = (int) $question['correct_answer'];

    if($user_choice == $correct_index) {
        echo "<h3 style='color:green;'>Doğru!</h3>";
        $_SESSION['score'] = ($_SESSION['score'] ?? 0) + 1;
    } else {
        echo "<h3 style='color:red;'>Yanlış! Doğru cevap: " . $answers[$correct_index - 1] . "</h3>";
    }

    echo "<ul class='   '>";
    foreach($answers as $index => $answer) {
        if (($index + 1) == $correct_index) {
            echo "<li style='color:green;'>" . $answer . " (Doğru)</li>";
        } elseif (($index + 1) == $user_choice) {
            echo "<li style='color:red;'>" . $answer . "</li>";
        } else {
            echo "<li>" . $answer . "</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<h3 style='color:red;'>Bu sayfaya doğrudan erişim sağlayamazsınız!</h3>";
    exit();
}

$next_question = $question_id + 1;
echo "<a class='start'   href='fetch.php?n=" . $next_question . "'>Sonraki Soru</a>";

include '../layout/footer.php';
?>