<?php
include './db.php';

$query = "SELECT * FROM questions";
$stmt = $pdo->query($query);

$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($questions as $question) {
    echo "<h2>" . $question['question'] . "</h2>";

    $answers = json_decode($question['answers'], true);

    $correct_index = (int) $question['correct_answer'] - 1;

    if (is_array($answers)) {
        echo "<ul>";
        foreach ($answers as $index => $answer) {
            if ($index == $correct_index) {
                echo "<li><strong>" . $answer . "</strong></li>";
            } else {
                echo "<li>" . $answer . "</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "Yanıtlar düzgün formatta değil veya boş!";
    }
}
?>