<?php

function saveTmpData($email, $pass, $firstname, $lastname, $city, $street, $flat, $zip, $phone) {
	$_SESSION['user_data']['tmp_email'] = $email;
	$_SESSION['user_data']['tmp_password'] = $pass;
	$_SESSION['user_data']['tmp_firstname'] = $firstname;
	$_SESSION['user_data']['tmp_lastname'] = $lastname;
	$_SESSION['user_data']['tmp_city'] = $city;
	$_SESSION['user_data']['tmp_street'] = $street;
	$_SESSION['user_data']['tmp_flat_number'] = $flat;
	$_SESSION['user_data']['tmp_zip'] = $zip;
	$_SESSION['user_data']['tmp_phone'] = $phone;
}

if (isLogged()) header('Location: index.php?site=home');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['firstname'])) {
		try {
			$email = strtolower(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
			if (!empty($email)) {
				$user = $service->getUser($email);
				if ($user === false) {
					$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$firstname = ucfirst(strtolower($_POST['firstname']));
					$lastname = ucfirst(strtolower($_POST['lastname']));
					$city = ucfirst(strtolower($_POST['city']));
					$street = ucfirst(strtolower($_POST['street']));

					$addres_id = $service->addAddres($city, $_POST['zip'], $street, $_POST['flat_number']);
					$query = $service->signup($email, $hash, $firstname, $lastname, $_POST['phone'], $addres_id['MAX(id)']);
					// header('Location: index.php?site=logout');
				} else {
					$error = "Taki email już istnieje";
				}
			} else {
				$error = "Podaj poprawny adres email";
			}
		} catch (Exception $e) {
			print_r($e);
		}
	} else {
		$error = "Wypełnij wymagane pola";
	}
	saveTmpData($_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['city'], $_POST['street'], $_POST['flat_number'], $_POST['zip'], $_POST['phone']);
}
?>


<div class='tile_main'>
	<form id="login" class="card container" style="display: flex; flex-direction: column;" method="post">
		<div style="display: flex;">
			<div class='control_panel' >
				<h1>Zarejestruj się</h1>
				<div class="field">
					<label class="label">Imię lub nazwa firmy</label>
					<input class="input" required type="text" name="firstname" placeholder="Jan" <?php if (isset($_SESSION['user_data']['tmp_firstname'])) echo'value="', $_SESSION['user_data']['tmp_firstname'], '"'; ?> >
				</div>

				<div class="field">
					<label class="label">Nazwisko</label>
					<input class="input" type="text" name="lastname" placeholder="Kowalski" <?php if (isset($_SESSION['user_data']['tmp_lastname'])) echo'value="', $_SESSION['user_data']['tmp_lastname'], '"'; ?> >
				</div>

				<div class="field">
					<label class="label">Email</label>
					<input class="input is-danger" required type="email" name="email" placeholder="Email" <?php if (isset($_SESSION['user_data']['tmp_email'])) echo'value="', $_SESSION['user_data']['tmp_email'], '"'; ?> >
				</div>

				<div class="field">
					<label class="label">Hasło</label>
					<input class="input" required type="password" name="password" placeholder="Hasło" <?php if (isset($_SESSION['user_data']['tmp_password'])) echo'value="', $_SESSION['user_data']['tmp_password'], '"'; ?> >
				</div>
			</div>

			<div class='control_panel' >
				<h1>Dane kontaktowe</h1>
				<div class="field">
					<div class="field">
						<label class="label">Miasto</label>
						<input class="input" type="text" name="city" placeholder="Wrocław" <?php if (isset($_SESSION['user_data']['tmp_city'])) echo'value="', $_SESSION['user_data']['tmp_city'], '"'; ?> >
					</div>
					<div class="field">
						<label class="label">Ulica</label>
						<input class="input" type="text" name="street" placeholder="Norwida" <?php if (isset($_SESSION['user_data']['tmp_street'])) echo'value="', $_SESSION['user_data']['tmp_street'], '"'; ?> >
					</div>
					<div class="field">
						<label class="label">Numer domu/mieszkania</label>
						<input class="input" type="text" name="flat_number" placeholder="15a" <?php if (isset($_SESSION['user_data']['tmp_flat_number'])) echo'value="', $_SESSION['user_data']['tmp_flat_number'], '"'; ?> >
					</div>
					<div class="field">
						<label class="label">Kod pocztowy</label>
						<input class="input" id="zip" name="zip" type="number" placeholder="00-000" inputmode="numeric" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$" <?php if (isset($_SESSION['user_data']['tmp_zip'])) echo'value="', $_SESSION['user_data']['tmp_zip'], '"'; ?>>
					</div>

					<div class="field">
						<label class="label">Numer kontaktowy</label>
						<input class="input" type="number" name="phone" placeholder="123456789" <?php if (isset($_SESSION['user_data']['tmp_phone'])) echo'value="', $_SESSION['user_data']['tmp_phone'], '"'; ?> >
					</div>
				</div>
			</div>
		</div>
		
		<div class="field">
			<label class="checkbox">
				<input type="checkbox" required>
				Zgadzam się z warunkami zawartymi w <a href="#"> regulaminie</a>
			</label>
		</div>
		
		<div><?php if (isset($error)) echo $error; ?></div>
		<div class="field">
			<button class="button is-link">Rejestracja</button>
		</div>
	</form>
</div>
