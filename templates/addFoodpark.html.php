<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Dodaj Food Park</h1>
    <form action="?task=foodpark&action=insert" method="post">
        <p class="input-name">Nazwa food parku: </p><input type="text" class = "form-control" name="nazwa_p" required/><br>
        <p class="input-name">Miasto: </p><input type="text" class = "form-control" name="miasto" required/><br>
        <p class="input-name">Kod pocztowy: </p><input type="text" class = "form-control" name="kod_pocz" required/><br>
        <p class="input-name">Ulica: </p><input type="text" class = "form-control" name="ulica" required/><br>
        <p class="input-name">Numer: </p><input type="number" class = "form-control" name="numer" required/><br>
        <input type="submit" value="Dodaj" />
    </form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>