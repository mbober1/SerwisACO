<?php 

if(!isLogged()) header('Location: index.php?site=queue');
else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['carSelect']) && isset($_POST['failure'])) {
            try {
                print_r($_POST['carSelect']);
                $query = $service->addToQueue($_POST['carSelect']);
                header('Location: index.php?site=queue');
            } catch (Exception $e) {
                $error = 'Wystąpił błąd';
                print_r($e);
            }
        }
    }
}
?>

<div class='background' style=' display: flex; align-items: center; justify-content: center;'>
	<div class="tile_main">
        <form id="addqueue" class="card container" method="post">
            
            <div class="field">
                <label class="label">Wybierz auto</label>
                <div class="control">
                    <select required name="carSelect">
                    <?php
                    $rows = $service->getCars(getUserID());
                    while ($row = array_shift($rows)) echo "<option value=", $row["id"], ">", $row["brand"], " ", $row["model"], " | ", $row["vin"]," </option>";?>
                    </select>
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
        </form>
    </div>
</div>