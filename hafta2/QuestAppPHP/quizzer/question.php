<?php include '../layout/header.php'; ?>
    <main>
        <div class="container">
            <div class="current">Soru 1/5</div>
            <p class="question">
                PHP neyin kısaltmasıdır?
            </p>
            <form method="post" action="process.php">
                <ul class="choices">
                    <li><input type="radio" name="choice" value="1" />Hypertext Preprocessor</li>
                    <li><input type="radio" name="choice" value="2" />Private Home Page</li>
                    <li><input type="radio" name="choice" value="3" />Personal Home Page</li>
                    <li><input type="radio" name="choice" value="4" />Personal Hypertext Preprocessor</li>
                </ul>
                <button type="submit">Soruyu İşaretle</button>
            </form>
        </div>
    </main>
<?php include '../layout/footer.php'; ?>
</body>
</html>