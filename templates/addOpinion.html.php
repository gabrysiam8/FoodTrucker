<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Dodaj opinię</h1>
    <form class=form-opinion action="?task=opinion&action=insert" method="post">
        <p class="input-name">Nazwa firmy: </p><input type="text" class = "form-control" name="nazwa_f" required/><br>
        <p class="input-name">Ocena: </p><input type="number" class = "form-control" step=0.5 min=1 max=5 name="ocena" required/><br>
        <p class="input-name">Informacja: </p><input type="text" class = "form-control" name="info" /><br>
        <p class="input-name">Autor: </p><input type="text" class = "form-control" name="autor" /><br>
        <input type="submit" value="Dodaj" />
    </form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>