<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Lista firm</h1>
    <table class="companies">
        <tbody>
            <tr>
                <th>nazwa firmy</th>
                <th>NIP</th>
                <th>ocena</th>
                <?php if (session_id() == "") session_start();
                if($_SESSION['username'] == 'admin'):?>
                <th></th>
                <th></th>
                <th></th>
                <?php endif; ?>
            </tr>

            <? foreach($this->get('companyData') as $companies) 
            { ?> 
            <tr>
                <td><?= $companies['nazwa_f']; ?></td>
                <td><?= $companies['nip']; ?></td>
                <td><?= $companies['ocena']; ?></td>
                <?php if (session_id() == "") session_start();?>
                <?php if($_SESSION['username'] == 'admin'):?>
                    <?$up = '?task=company&action=add&compId='.$companies['id_firmy'].'&nazwa_f='.$companies['nazwa_f'].'&nip='.$companies['nip'];?>
                    <td><input type="button" value="Modyfikuj" onclick=" location.href= '<?=$up;?>' " /></td>
                    <?$del = '?task=company&action=delete&compId='.$companies['id_firmy'];?>
                    <td><input type="button" value="Usuń" onclick=" location.href= '<?=$del;?>' " /></td>
                    <?$add = '?task=menu&action=add&compId='.$companies['id_firmy'];?>
                    <td><input type="button" value="Dodaj danie do menu" onclick=" location.href= '<?=$add;?>' " /></td>
                <?php endif; ?>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>