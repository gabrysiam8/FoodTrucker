<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Lista food parków</h1>
    <table>
        <tbody>
            <tr>
                <th>nazwa</th>
                <th>miasto</th>
                <th>ulica</th>
                <th>numer</th>
                <?php if (session_id() == "") session_start();
                if($_SESSION['username'] == 'admin'):?>
                <th></th>
                <?php endif; ?>
            </tr>
            <? foreach($this->get('foodparkData') as $foodparks) 
            { ?>
                <tr>
                <td><?= $foodparks['nazwa_p']; ?></td>
                <td><?= $foodparks['miasto']; ?></td>
                <td><?= $foodparks['ulica']; ?></td>
                <td><?= $foodparks['numer']; ?></td>
                <?php if (session_id() == "") session_start();?>
                <?php if($_SESSION['username'] == 'admin'):?>
                    <?$del = '?task=foodpark&action=delete&fpId='.$foodparks['id_foodparku'];?>
                    <td><input type="button" value="Usuń" onclick=" location.href= '<?=$del;?>' " /></td>
                <?php endif; ?>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>