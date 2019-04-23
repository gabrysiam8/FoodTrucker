<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Lista food trucków</h1>
    <table class="foodtrucks">
        <tbody>
            <tr>
                <th>nazwa firmy</th>
                <th>nazwa food parku</th>
                <th>miasto</th>
                <th>ulica</th>
                <th>numer</th>
                <th>godzina otwarcia</th>
                <th>godzina zamkniecia</th>
                <th>telefon</th>
                <?php if (session_id() == "") session_start();
                if($_SESSION['username'] == 'admin'):?>
                <th></th>
                <th></th>
                <?php endif; ?>
            </tr>

            <? foreach($this->get('foodtruckData') as $foodtrucks) 
            { ?> 
            <tr>
                <td><?= $foodtrucks['nazwa_f']; ?></td>
                <td><?= $foodtrucks['nazwa_p']; ?></td>
                <td><?= $foodtrucks['miasto']; ?></td>
                <td><?= $foodtrucks['ulica']; ?></td>
                <td><?= $foodtrucks['numer']; ?></td>
                <td><?= $foodtrucks['godzina_otwarcia']; ?></td>
                <td><?= $foodtrucks['godzina_zamkniecia']; ?></td>
                <td><?= $foodtrucks['telefon']; ?></td>
                <?php if (session_id() == "") session_start();?>
                <?php if($_SESSION['username'] == 'admin'):?>
                    <?$up = '?task=foodtruck&action=add&ftId='.$foodtrucks['id_foodtrucka'].'&nazwa_f='.$foodtrucks['nazwa_f'].'&nazwa_p='.$foodtrucks['nazwa_p'].'&go='.$foodtrucks['godzina_otwarcia'].'&gz='.$foodtrucks['godzina_zamkniecia'].'&tel='.$foodtrucks['telefon'];?>
                    <td><input type="button" value="Modyfikuj" onclick=" location.href= '<?=$up;?>' " /></td>
                    <?$del = '?task=foodtruck&action=delete&ftId='.$foodtrucks['id_foodtrucka'];?>
                    <td><input type="button" value="Usuń" onclick=" location.href= '<?=$del;?>' " /></td>
                <?php endif; ?>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>