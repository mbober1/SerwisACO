<?php 

if(!isLogged() || getUserPermissions()) header('Location: index.php?site=queue');
else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['carSelect']) && isset($_POST['failure'])) {
            try {
                print_r($_POST['carSelect']);
                $query = $service->addToQueue($_POST['carSelect'], $_POST['failure']);
                header('Location: index.php?site=queue');
            } catch (Exception $e) {
                $error = 'Wystąpił błąd';
                print_r($e);
            }
        }
    }
}

echo '
<div class="background" style=" display: flex; align-items: center; justify-content: center;">
    <div class="tile_main">';

$rows = $service->getCars(getUserID());
if ($rows) {
    echo '
    <form id="addqueue" class="card container" method="post" style="padding: 15px;">
    <div class="field">
        <label class="label">Wybierz auto</label>
            <div class="control">';

    echo '<select required name="carSelect" class="dropdown-content">';
    while ($row = array_shift($rows)) echo "<option value=", $row["id"], ">", $row["brand"], " ", $row["model"], " | ", $row["vin"]," </option>";
    echo '</select>
        </div>
    </div>
    <div class="field">
    <label class="label">Wypisz usterki</label>
    <div class="control">
        <input class="input" required type="text" name="failure" placeholder="np. auto nie odpala na zmnym">
    </div>
</div>

<div class="field is-grouped">
<div class="control">
    <button class="button is-link">Dodaj</button>
</div>
<div class="control">
    <a href="index.php?site=queue"><button class="button is-link is-light">Anuluj</button></a>
</div>
</div>
</form>'; 


} else {
    echo '<div id="addqueue" class="card container" method="post" style="padding: 15px;">';
    echo "Nie masz dodanych żadnych pojazdów";
    echo '<div class="control"><a href="index.php?site=addcar"><button class="button is-link">Dodaj auto</button></a></div></div>';
}

echo '</div>
</div>';

?>

                    



