<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Wyszukaj menu danej firmy</h1>
    <form action="?task=menu&action=index" method="post">
        <p class="input-name">Nazwa firmy: </p>
        <select name="nazwa_f">
        <? foreach($this->get('companyData') as $companies) 
        { ?>  
            <option><?= $companies['nazwa_f']; ?></option> 
        <? } ?>
        </select><br>
        <button type = "submit" name = "search">Szukaj</button> 
    </form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>