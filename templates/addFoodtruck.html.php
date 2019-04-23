<? include 'templates/header.html.php'; ?></pre>
<div class="content">
<?php if(empty($_GET['ftId']) && empty($_GET['eventId'])):?>
    <h1>Dodaj Food Truck</h1>
    <form action="?task=foodtruck&action=insert" method="post">
<?php elseif(!empty($_GET['eventId'])):?>
    <h1>Dodaj Food Truck do wydarzenia</h1>
    <?$add = '?task=event&action=insertFoodtruckEvent&eventId='.$_GET['eventId'];?>
    <form action="<?=$add;?>" method="post">
<?php else: ?>
    <h1>Modyfikuj Food Truck</h1>
    <?$up = '?task=foodtruck&action=update&ftId='.$_GET['ftId'];?>
    <form action="<?=$up;?>" method="post">
<?php endif; ?>
    <p class="input-name">Nazwa firmy: </p><input type="text" class = "form-control" name="nazwa_f" value="<?= $_GET['nazwa_f']; ?>" required/><br>
    <p class="input-name">Nazwa food parku: </p><input type="text" class = "form-control" name="nazwa_p" value="<?= $_GET['nazwa_p']; ?>" required/><br>
    <?php if(empty($_GET['eventId'])):?>
        <p class="input-name">Godzina otwarcia: </p><input type="time" class = "form-control" name="godz_otwarcia" value="<?= $_GET['go']; ?>" required/><br>
        <p class="input-name">Godzina zamkniecia: </p><input type="time" class = "form-control" name="godz_zamkniecia" value="<?= $_GET['gz']; ?>" required/><br>
        <p class="input-name">Telefon: </p><input type="text" class = "form-control" name="telefon" value="<?= $_GET['tel']; ?>" /><br>
    <?php endif; ?>
    <input type="submit" value="Dodaj" />
</form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>