<div class="baner">
    <a href="index.php">
        <div id="logo">
            <div id="logo_main">SERWIS <font color="#f44336">ACO</font></div>
            <div id="logo_second">TWÓJ AUTO SERWIS</div>
        </div>
    </a> 

    <div class="menu">
        <a href="index.php?site=home"><div class='menu_button'>STRONA GŁÓWNA</div></a>
        <a href="index.php?site=queue"><div class='menu_button'>KOLEJKA NAPRAW</div></a>
        <a href="index.php?site=control"><div class='menu_button'>PANEL KLIENTA</div></a>
        <a href="index.php?site=contact"><div class='menu_button'>KONTAKT</div></a>
        <?php if (isLogged()) echo '<a href="index.php?site=logout"><div class="menu_button">WYLOGUJ</div></a>'; else echo '<a href="index.php?site=signin"><div class="menu_button">ZALOGUJ</div></a>'; ?>
        <div class='menu_button'> <img src="img/search.png" height="20" width="20"></div>
    </div>
</div>
