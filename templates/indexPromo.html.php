<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Lista promocji</h1>
    <table class="promos">
        <tbody>
            <tr>
                <th>rodzaj</th>
                <th>start</th>
                <th>koniec</th>
                <th>firmy biorące udział</th>
                <?php if (session_id() == "") session_start();
                if($_SESSION['username'] == 'admin'):?>
                <th></th>
                <th></th>
                <?php endif; ?>
            </tr>

            <? foreach($this->get('promoData') as $promos) 
            { ?> 
            <tr>
                <td><?= $promos['rodzaj']; ?></td>
                <td><?= $promos['start']; ?></td>
                <td><?= $promos['koniec']; ?></td>
                <?$url = '?task=company&action=getByPromo&promoId='.$promos['id_promocji'];?>
                <td><input type="button" value="Szukaj" onclick=" location.href= '<?=$url;?>' " /></td>
                <?php if (session_id() == "") session_start();?>
                <?php if($_SESSION['username'] == 'admin'):?>
                    <?$del = '?task=promo&action=delete&promoId='.$promos['id_promocji'];?>
                    <td><input type="button" value="Usuń" onclick=" location.href= '<?=$del;?>' " /></td>
                    <?$add = '?task=promo&action=addCompany&promoId='.$promos['id_promocji'];?>
                    <td><input type="button" value="Dodaj firmę biorącą udział" onclick=" location.href= '<?=$add;?>' " /></td>
                <?php endif; ?>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>