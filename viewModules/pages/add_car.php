<?php
if (!isLogged())
	header('Location: index.php?site=home');
else {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if (isset($_POST['brand']) && isset($_POST['model']) && isset($_POST['mileage']) && isset($_POST['vin']) && isset($_POST['power'])) {
			try {
				$brand = ucfirst(strtolower($_POST['brand']));
				$model = ucfirst(strtolower($_POST['model']));
				$vin = strtoupper($_POST['vin']);
				$ownerid = getUserID();
				$query = $service->addcar($ownerid, $brand, $model, $vin, $_POST['mileage'], $_POST['power']);
				header('Location: index.php?site=control');
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
        <form id="addcar" class="card container" method="post" style="padding: 15px;">

            <div class="field">
				<label class="label">Marka</label>
				<div class="control">
					<input class="input" type="text" placeholder="np. Ford" name="brand">
				</div>
            </div>

            <div class="field">
				<label class="label">Model</label>
				<div class="control">
					<input class="input" type="text" placeholder="np. Focus" name="model">
				</div>
            </div>

            <div class="field">
				<label class="label">Przebieg w km</label>
				<div class="control">
					<input class="input" type="number" placeholder="np. 300000" name="mileage">
				</div>
            </div>

            <div class="field">
				<label class="label">Nr VIN</label>
				<div class="control">
					<input class="input" type="text" placeholder="XXXXXXXXXXXXXXXXX" name="vin">
				</div>
            </div>

            <div class="field">
				<label class="label">Moc w KM</label>
				<div class="control">
					<input class="input" type="number" placeholder="101" name="power">
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