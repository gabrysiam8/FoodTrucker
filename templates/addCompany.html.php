<? include 'templates/header.html.php'; ?></pre>
<div class="content">
    <?php if(empty($_GET['compId']) && empty($_GET['promoId']) && empty($_GET['dishId'])):?>
        <h1>Dodaj firmę</h1>
        <form action="?task=company&action=insert" method="post">
    <?php elseif(!empty($_GET['promoId'])):?>
        <h1>Dodaj firmę</h1>
        <?$add = '?task=promo&action=insertCompanyPromo&promoId='.$_GET['promoId'];?>
        <form action="<?=$add;?>" method="post">
    <?php elseif(!empty($_GET['dishId'])):?>
        <h1>Dodaj firmę</h1>
        <?$add = '?task=menu&action=insertCompanyDish&dishId='.$_GET['dishId'];?>
        <form action="<?=$add;?>" method="post">
    <?php else: ?>
        <h1>Modyfikuj firmę</h1>
        <?$up = '?task=company&action=update&compId='.$_GET['compId'];?>
        <form action="<?=$up;?>" method="post">
    <?php endif; ?>
        <p class="input-name">Nazwa firmy: </p><input type="text" class = "form-control" name="nazwa_f" value="<?= $_GET['nazwa_f']; ?>" required/><br>
        <?php if(empty($_GET['promoId']) && empty($_GET['dishId'])):?>
            <p class="input-name">NIP: </p><input type="text" class = "form-control" name="nip" value="<?= $_GET['nip']; ?>" required/><br>
        <?php endif; ?>
        <input type="submit" value="Dodaj" />
    </form>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>