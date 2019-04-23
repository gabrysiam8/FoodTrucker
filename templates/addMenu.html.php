<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Dodaj danie</h1>
    <?$add = '?task=menu&action=insert&compId='.$_GET['compId'];?>
    <form action="<?=$add;?>" method="post">
        <p class="input-name">Nazwa dania: </p><input type="text" class = "form-control" name="nazwa_d" required/><br>
        <p class="input-name">Nazwa typu kuchni: </p><input type="text" class = "form-control" name="nazwa_t" required/><br>
        <input type="submit" value="Dodaj" />
    </form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>