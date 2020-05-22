<?php
if (!isLogged())
	header('Location: index.php?site=home');
else {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

		if (isset($_POST['brand']) && isset($_POST['model']) && isset($_POST['vin']) && isset($_POST['mileage'])) {
			try {
				$brand = ucfirst(strtolower($_POST['brand']));
				$model = ucfirst(strtolower($_POST['model']));
				$color = ucfirst(strtolower($_POST['body_color']));
				$vin = strtoupper($_POST['vin']);
				$ownerid = getUserID();
				$query = $service->addcar($ownerid, $brand, $model, $vin, $_POST['mileage'], $_POST['power'], $_POST['engine_capacity'], $_POST['fuel'], $color, $_POST['number_doors'] );
				header('Location: index.php?site=control');
			} catch (Exception $e) {
				$error = 'Wystąpił błąd';
				print_r($e);
			}
		}
	}
}
?>



<div class="tile_main">
	<form id="addcar" class="card container" method="post" style="padding: 15px;">

		<div class="field">
			<label class="label">Marka</label>
			<input required class="input" type="text" placeholder="np. Ford" name="brand">
		</div>

		<div class="field">
			<label class="label">Model</label>
			<input required class="input" type="text" placeholder="np. Focus" name="model">
		</div>

		<div class="field">
			<label class="label">Przebieg w km</label>
			<input class="input" type="number" placeholder="np. 300000" name="mileage">
		</div>

		<div class="field">
			<label class="label">Nr VIN</label>
			<input required class="input" type="text" placeholder="XXXXXXXXXXXXXXXXX" name="vin">
		</div>

		<div class="field">
			<label class="label">Moc w KM</label>
			<input class="input" type="number" placeholder="101" name="power">
		</div>

		<div class="field">
			<label class="label">Pojemność silnika w cm³</label>
			<input class="input" type="number" placeholder="1957" name="engine_capacity">
		</div>

		<div class="field">
			<label class="label">Paliwo</label>
			<select name="fuel" class="dropdown-content">
				<option value="Benzyna">Benzyna</option>
				<option value="Benzyna + gaz">Benzyna + gaz</option>
				<option value="Diesel">Diesel</option>
				<option value="Hybryda">Hybryda</option>
			</select>
		</div>

		<div class="field">
			<label class="label">Kolor nadwozia</label>
			<input class="input" type="text" placeholder="Czarny" name="body_color">
		</div>

		<div class="field">
			<label class="label">Liczba drzwi</label>
			<input class="input" type="number" placeholder="5" name="number_doors">
		</div>

		<div class="field is-grouped">
			<button class="button is-link">Dodaj</button>
			<a href="index.php?site=queue"><button class="button is-link is-light">Anuluj</button></a>
		</div>
	</form>
</div>