<?php
include './db.php';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    $choice1 = $_POST['choice1'];
    $choice2 = $_POST['choice2'];
    $choice3 = $_POST['choice3'];
    $choice4 = $_POST['choice4'];
    $correct_choice = $_POST['correct_choice'];

    $answers = json_encode([$choice1, $choice2, $choice3, $choice4]);

    $correct_answer = $_POST["choice" . $correct_choice];

    $sql = "INSERT INTO questions (question, answers, correct_answer) VALUES (:question, :answers, :correct_answer)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'question' => $question_text,
        'answers' => $answers,
        'correct_answer' => $correct_choice
    ]);

    echo "<div class='success-message'>Soru başarıyla eklendi!</div>";
    header('Refresh: 2; URL=add.php');
} else {
    echo "Bu sayfaya sadece POST metoduyla erişilebilir!";
}

?>