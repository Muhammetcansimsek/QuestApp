<?php include '../layout/header.php'; ?>

<main>
    <div class="container">
        <h2>Soru Ekle</h2>
        <form action="insert.php" method="POST">
            <p>
                <label>Soru Numarası: </label>
                <input type="number" name="question_number">
            </p>
            <p>
                <label>Soru Metni: </label>
                <input type="text" name="question_text">
            </p>
            <p>
                <label>Seçenek 1: </label>
                <input type="text" name="choice1">
            </p>
            <p>
                <label>Seçenek 2: </label>
                <input type="text" name="choice2">
            </p>
            <p>
                <label>Seçenek 3: </label>
                <input type="text" name="choice3">
            </p>
            <p>
                <label>Seçenek 4: </label>
                <input type="text" name="choice4">
            </p>
            <p>
                <label>Doğru Cevap: </label>
                <input type="number" name="correct_choice">
            </p>
            <p>
                <input type="submit" name="submit" value="Soruyu Ekle">
            </p>
        </form>
    </div>

</main>

<?php include '../layout/footer.php'; ?>