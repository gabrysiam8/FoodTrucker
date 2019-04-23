<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <h1>Menu</h1>
    <table class="menu">
        <tbody>
            <tr>
                <th>nazwa dania</th>
                <th>typ kuchni</th>
                <th>firmy serwujące danie</th>
                <?php if (session_id() == "") session_start();
                if($_SESSION['username'] == 'admin'):?>
                <th></th>
                <?php endif; ?>
            </tr>

            <? foreach($this->get('menuData') as $menu) 
            { ?> 
            <tr>
                <td><?= $menu['nazwa_d']; ?></td>
                <td><?= $menu['nazwa_t']; ?></td>
                <?$url = '?task=company&action=getByDish&dishId='.$menu['id_dania'];?>
                <td><input type="button" value="Szukaj" onclick=" location.href= '<?=$url;?>' " /></td>
                <?php if (session_id() == "") session_start();?>
                <?php if($_SESSION['username'] == 'admin'):?>
                    <?$del = '?task=menu&action=delete&dishId='.$menu['id_dania'].'&compId='.$menu['id_firmy'];?>
                    <td><input type="button" value="Usuń" onclick=" location.href= '<?=$del;?>' " /></td>
                <?php endif; ?>
            </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>