<div class="baner">
    <a href="index.php">
        <div id="logo">
            <div id="logo_main">SERWIS <font color="#f44336">ACO</font></div>
            <div id="logo_second">TWÓJ AUTO SERWIS</div>
        </div>
    </a> 

    <div class="menu">
        <a href="index.php?site=home"><div class='menu_button'>STRONA GŁÓWNA</div></a>
        
        <?php if (isLogged()) {
            echo '<a href="index.php?site=queue"><div class="menu_button">KOLEJKA NAPRAW</div></a>';
            echo '<a href="index.php?site=control">';
            $perm = getUserPermissions();
            if($perm==0) echo '<div class="menu_button">PANEL KLIENTA</div>';
            elseif($perm==1) echo '<div class="menu_button">PANEL PRACOWNIKA</div>';
            elseif($perm==2) echo '<div class="menu_button">PANEL ADMINA</div>';
            echo '</a>';
        }  ?>
        <a href="index.php?site=contact"><div class='menu_button'>KONTAKT</div></a>
        <?php if (isLogged()) echo '<a href="index.php?site=logout"><div class="menu_button">WYLOGUJ</div></a>'; else echo '<a href="index.php?site=signin"><div class="menu_button">ZALOGUJ</div></a><a href="index.php?site=signup"><div class="menu_button">ZAREJESTRUJ</div></a>'; ?>
        <div class='menu_button'> <img src="img/search.png" height="20" width="20"></div>
    </div>
</div>
