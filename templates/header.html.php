<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" /></pre>
<div>
    <img src="images/icon.png" width="200" height="150" style="vertical-align: baseline;">
    <a href="index.php" class="app_name">Food Trucker</a>
</div>
    <div class="client_menu">
        <div class="dropdown">
            <button class="dropbtn">Food Trucki 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="?task=foodtruck&action=getByCompany">danej firmy</a>
                <a href="?task=foodtruck&action=getByFoodpark">w danym Food Parku</a>
            </div>
        </div>
        <a href="?task=menu&action=getByCompany">Menu</a>
        <div class="dropdown">
            <button class="dropbtn">Wydarzenia
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="?task=event&action=index">wszystkie</a>
                <a href="?task=event&action=getFuture">nadchodzące</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Promocje
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="?task=promo&action=index">wszystkie</a>
                <a href="?task=promo&action=getActual">aktualne</a>
            </div>
        </div>
        <a href="?task=opinion&action=add">Dodaj opinię</a>
        <?php if (session_id() == "") session_start();
        if($_SESSION['username'] == 'admin'):?>
            <div class="dropdown">
                <button class="dropbtn">Edytuj bazę Food Trucków
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="?task=foodtruck&action=add">dodaj</a>
                    <a href="?task=foodtruck&action=index">modyfikuj/usuń</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Edytuj bazę firm
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="?task=company&action=add">dodaj</a>
                    <a href="?task=company&action=index">modyfikuj/usuń</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Edytuj bazę Food Parków
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="?task=foodpark&action=add">dodaj</a>
                    <a href="?task=foodpark&action=index">usuń</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Edytuj bazę wydarzeń
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="?task=event&action=add">dodaj</a>
                    <a href="?task=event&action=index">usuń</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">Edytuj bazę promocji
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="?task=promo&action=add">dodaj</a>
                    <a href="?task=promo&action=index">usuń</a>
                </div>
            </div>
            <a href="?logout=1">Wyloguj się</a>
        <?php else: ?>
            <a href="index.php">Zaloguj się</a>
        <?php endif; ?>
    </div>
<pre>