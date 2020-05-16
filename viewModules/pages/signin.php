<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	if (isset($_POST['email']) && isset($_POST['password'])) {
		try {
			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			if (empty($email)) {
				$_SESSION['user_data']['tmp_email'] = $_POST['email'];
				$_SESSION['user_data']['tmp_password'] = $_POST['password'];
				header('Location: index.php?site=signin');
			} else {
				$user = $service->getUser($email);
				if ($user) {
					if (password_verify($_POST['password'], $user['password'])) {
						$_SESSION['user_data']['logged_in'] = true;
						$_SESSION['user_data']['user_id'] = $user['id'];
						$_SESSION['user_data']['user_firstname'] = $user['firstname'];
						$_SESSION['user_data']['permissions'] = $user['permission'];
						header('Location: index.php');
					} else
						throw new Exception('Not found');
				} else
					throw new Exception('Not found');
			}
		} catch (Exception $e) {
			$_SESSION['user_data']['tmp_email'] = $_POST['email'];
			$_SESSION['user_data']['tmp_password'] = $_POST['password'];
			$error = 'Nieprawidłowy email lub hasło';
		}
	}
}
?>

<div class="tile_main">
	<form id="login" class="card container" style="flex-direction: column;" method="post">
		<div class="field">
			<h1>Zaloguj się</h1>
			<p class="has-icons-left has-icons-right">
				<input class="input" type="email" name="email" placeholder="Email" <?php if (isset($_SESSION['user_data']['tmp_email'])) echo'value="', $_SESSION['user_data']['tmp_email'], '"'; ?> >
			</p>
		</div>
		<div class="field">
			<p class="has-icons-left">
				<input class="input" type="password" name="password" placeholder="Password" <?php if (isset($_SESSION['user_data']['tmp_password'])) echo'value="', $_SESSION['user_data']['tmp_password'], '"'; ?>>
			</p>
		</div>
		<div class="field" style="display: flex; flex-direction: row;">
			<button class="button is-link">Zaloguj</button>
		</div>
	</form>

	<form id="register" class="card container" action="index.php?site=signup" method="post">
		<div style="display: flex; align-items: center; justify-content: space-around; padding: 10px;">
			<div>Nie masz konta?</div>
			<button class="button is-link">Zarejestruj się</button>
		</div>

		<?php
		if (isset($error))
			echo $error;
		elseif (isset($_SESSION['user_data']['tmp_email']) || isset($_SESSION['user_data']['tmp_password']))
			echo'Wprowadź poprawny adres email';
		?>
	</form>
</div>
