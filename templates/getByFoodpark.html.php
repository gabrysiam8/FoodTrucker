<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Wyszukaj Food Trucki w danym Food Parku</h1>
    <form action="?task=foodtruck&action=selectByFoodpark" method="post">
        <p class="input-name">Nazwa Food Parku: </p>
        <select name="nazwa_p">
        <? foreach($this->get('foodparkData') as $foodparks) 
        { ?>  
            <option><?= $foodparks['nazwa_p']; ?></option> 
        <? } ?>
        </select><br>
        <button type = "submit" name = "search">Szukaj</button> 
    </form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>