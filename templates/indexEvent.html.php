<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Lista wydarzeń</h1>
    <table class="events">
        <tbody>
            <tr>
                <th>nazwa</th>
                <th>data</th>
                <th>miasto</th>
                <th>ulica</th>
                <th>numer</th>
                <th>Food Trucki biorące udział</th>
                <?php if (session_id() == "") session_start();
                if($_SESSION['username'] == 'admin'):?>
                <th></th>
                <th></th>
                <?php endif; ?>
            </tr>

            <? foreach($this->get('eventData') as $events) 
            { ?> 
            <tr>
                <td><?= $events['nazwa']; ?></td>
                <td><?= $events['data']; ?></td>
                <td><?= $events['miasto']; ?></td>
                <td><?= $events['ulica']; ?></td>
                <td><?= $events['numer']; ?></td>
                <?$url = '?task=foodtruck&action=getByEvent&eventId='.$events['id_wydarzenia'];?>
                <td><input type="button" value="Szukaj" onclick=" location.href= '<?=$url;?>' " /></td>
                <?php if (session_id() == "") session_start();?>
                <?php if($_SESSION['username'] == 'admin'):?>
                    <?$del = '?task=event&action=delete&eventId='.$events['id_wydarzenia'];?>
                    <td><input type="button" value="Usuń" onclick=" location.href= '<?=$del;?>' " /></td>
                    <?$add = '?task=event&action=addFoodtruck&eventId='.$events['id_wydarzenia'];?>
                    <td><input type="button" value="Dodaj Food Truck biorący udział" onclick=" location.href= '<?=$add;?>' " /></td>
                <?php endif; ?>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>