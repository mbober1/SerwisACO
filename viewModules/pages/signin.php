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
				if (password_verify($_POST['password'], $user['password'])) {
					$_SESSION['user_data']['logged_in'] = true;
					$_SESSION['user_data']['user_id'] = $user['id'];
					$_SESSION['user_data']['user_firstname'] = $user['firstname'];
					$_SESSION['user_data']['permissions'] = $user['permission'];
					header('Location: index.php');
				}
				else throw new Exception('Not found');
			}
        }
        catch (Exception $e){
			$_SESSION['user_data']['tmp_email'] = $_POST['email'];
			$_SESSION['user_data']['tmp_password'] = $_POST['password'];
			$error = 'Nieprawidłowy email lub hasło';
        }
    }
}

?>

<div class='background'>
	<div class="tile_main">
		<form id="login" class="card container" method="post">
		<h1>Zaloguj się</h1>
				<div class="field">
				<p class="has-icons-left has-icons-right">
					<input class="input" type="email" name="email" placeholder="Email" <?php if(isset($_SESSION['user_data']['tmp_email'])) echo'value="',$_SESSION['user_data']['tmp_email'],'"'; ?> >
					<span class="icon is-small is-left">
					<i class="fas fa-envelope"></i>
					</span>
					<span class="icon is-small is-right">
					<i class="fas fa-check"></i>
					</span>
				</p>
				</div>
				<div class="field">
				<p class="has-icons-left">
					<input class="input" type="password" name="password" placeholder="Password" <?php if(isset($_SESSION['user_data']['tmp_password'])) echo'value="',$_SESSION['user_data']['tmp_password'],'"'; ?>>
					<span class="icon is-small is-left">
					<i class="fas fa-lock"></i>
					</span>
				</p>
				</div>
				<div class="field is-grouped">
					<button class="button is-link">Zaloguj</button>
			<div><?php if(isset($error)) echo $error; elseif(isset($_SESSION['user_data']['tmp_email']) || isset($_SESSION['user_data']['tmp_password'])) echo'Wprowadź poprawny adres email'; ?></div>
		</form>
	</div>
</div>