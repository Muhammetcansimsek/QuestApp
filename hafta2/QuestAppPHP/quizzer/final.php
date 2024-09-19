<?php
include '../layout/header.php'; 
session_start();
?>
<main>
    <div class="container">
        <h2>Test Bitti!</h2>
        <p>Doğru Cevaplar Yeşil, Yanlış Cevaplar Kırmızı renk ile gösterilmektedir.</p>
        <p>Toplam Puanınız: <?php echo $_SESSION['score'] ?? '0'; ?></p>
        <a href="fetch.php?n=1" class="start">Tekrar Başla</a>
    </div>
</main>

<?php include '../layout/footer.php'; ?>