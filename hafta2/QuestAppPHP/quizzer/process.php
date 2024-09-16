<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];
    $user_choice = $_POST['choice'];

    $query = "SELECT * FROM questions WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $question_id]);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    $answers = json_decode($question['answers'], true);
    $correct_index = (int) $question['correct_answer'];

    if($user_choice == $correct_index) {
        echo "<h3 style='color:green;'>Doğru!</h3>";
    } else {
        echo "<h3 style='color:red;'>Yanlış! Doğru cevap: " . $answers[$correct_index - 1] . "</h3>";
    }

    echo "<ul class='choices'>";
    foreach($answers as $index => $answer) {
        if (($index + 1) == $correct_index) {
            echo "<li style='color:green;'>" . $answer . "</li>";
        } elseif (($index + 1) == $user_choice) {
            echo "<li style='color:red;'>" . $answer . "</li>";
        } else {
            echo "<li>" . $answer . "</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<h3 style='color:red;'>Bu sayfaya doğrudan erişim sağlayamazsınız!</h3>";
}

$next_question = $question_id + 1;
echo "<a href='fetch.php?n=" . $next_question . "'>Sonraki Soru</a>";

?>