<?php
include './db.php';

$userTable = "
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL,
    role TEXT CHECK(role IN ('admin', 'student')) NOT NULL
)";

$pdo->exec($userTable);

$questionTable = "
CREATE TABLE IF NOT EXISTS questions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    answers TEXT NOT NULL,
    correct_answer TEXT NOT NULL
)";
$pdo->exec($questionTable);

$submissionsTable = "
CREATE TABLE IF NOT EXISTS submissions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    question_id INTEGER,
    is_correct BOOLEAN,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (question_id) REFERENCES questions(id)
)";

$pdo->exec($submissionsTable);

echo "Tablolar başarıyla oluşturuldu!";
?>