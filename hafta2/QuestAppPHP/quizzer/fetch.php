<?php
include './db.php';

$question_number = isset($_GET['n']) ? (int) $_GET['n'] : 1;

$query = "SELECT * FROM questions WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $question_number]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$question) {
    echo "<p>Böyle bir soru yok!</p>";
    exit();
}

$answers = json_decode($question['answers'], true);

if (is_array($answers)) {
    echo "<form method='POST' action='process.php?n=" . $question_number . "'>";
    echo "<ul class='choices'>";
    foreach ($answers as $i => $answer) {
        echo "<li><input type='radio' name='choice' value='" . ($i + 1) . "' />" . $answer . "</li>";
    }
    echo "</ul>";
    echo "<input type='hidden' name='question_id' value='" . $question['id'] . "' />";
    echo "<button type='submit'>Soruyu İşaretle</button>";
    echo "</form>";
} else {
    echo "Yanıtlar düzgün formatta değil veya boş!";
}
?>