<?php include '../layout/header.php'; ?>
    <main>
        <div class="container">
            <h2>Test Bitti!</h2>
            <p>Doğru Cevaplar Yeşil, Yanlış Cevaplar Kırmızı renk ile gösterilmektedir.</p>
            <p>Toplam Puanınız: <?php echo $_SESSION['score']; ?></p>
            <a href="question.php?n=1" class="start">Tekrar Başla</a>
        </div>
    </main>

<?php include '../layout/footer.php'; ?>