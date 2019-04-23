<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Dodaj promocję</h1>
    <form class=form-opinion action="?task=promo&action=insert" method="post">
        <p class="input-name">Rodzaj: </p><input type="text" class = "form-control" name="rodzaj" required/><br>
        <p class="input-name">Start: </p><input type="date" class = "form-control" name="start" required/><br>
        <p class="input-name">Koniec: </p><input type="date" class = "form-control" name="koniec" required/><br>
        <input type="submit" value="Dodaj" />
    </form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>