<?php 
if(isLogged()) header('Location: index.php?site=home');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
        try {
			$email = strtolower(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
			if (empty($email)) {
				$_SESSION['user_data']['tmp_email'] = $_POST['email'];
				$_SESSION['user_data']['tmp_password'] = $_POST['password'];
				$_SESSION['user_data']['tmp_firstname'] = $_POST['firstname'];
				$_SESSION['user_data']['tmp_lastname'] = $_POST['lastname'];
				header('Location: index.php?site=signin');
			} else {
                $user = $service->getUser($email);
                print_r($user==false);
                if ($user===false) {
                    print_r("dupa");
                    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $firstname = ucfirst(strtolower($_POST['firstname']));
                    $lastname = ucfirst(strtolower($_POST['lastname']));
                    $query = $service->signup($email, $hash, $firstname, $lastname);
					header('Location: index.php');
				}
				else {
                    $error = "Taki email już istnieje";
                }
			}
        }
        catch (Exception $e){
			$_SESSION['user_data']['tmp_email'] = $_POST['email'];
			$_SESSION['user_data']['tmp_password'] = $_POST['password'];
            $_SESSION['user_data']['tmp_firstname'] = $_POST['firstname'];
            $_SESSION['user_data']['tmp_lastname'] = $_POST['lastname'];
            $error = 'Taki 2email już istnieje';
            print_r($e);
        }
    }
}

?>


<div class='background'>
	<div class="tile_main">
        <form id="login" class="card container" method="post">

            <div class="field">
                <label class="label">Imię</label>
                <div class="control">
                    <input class="input" required type="text" name="firstname" placeholder="Jan" <?php if(isset($_SESSION['user_data']['tmp_firstname'])) echo'value="',$_SESSION['user_data']['tmp_firstname'],'"'; ?> >
                </div>
            </div>

            <div class="field">
                <label class="label">Nazwisko</label>
                <div class="control">
                    <input class="input" required type="text" name="lastname" placeholder="Kowalski" <?php if(isset($_SESSION['user_data']['tmp_lastname'])) echo'value="',$_SESSION['user_data']['tmp_lastname'],'"'; ?> >
                </div>
            </div>

            <div class="field">
            <label class="label">Email</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input is-danger" required type="email" name="email" placeholder="Email" <?php if(isset($_SESSION['user_data']['tmp_email'])) echo'value="',$_SESSION['user_data']['tmp_email'],'"'; ?> >
                <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- <p class="help is-danger">Wprowadź poprawny adres email</p> -->
            </div>

            <div class="field">
            <label class="label">Hasło</label>
            <p class="control has-icons-left">
                <input class="input" required type="password" name="password" placeholder="Hasło" <?php if(isset($_SESSION['user_data']['tmp_password'])) echo'value="',$_SESSION['user_data']['tmp_password'],'"'; ?> >
                <span class="icon is-small is-left">
                <i class="fas fa-lock"></i>
                </span>
            </p>
            </div>


            <div class="field">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" required>
                Zgadzam się z warunkami zawartymi w <a href="#"> regulaminie</a>
                </label>
            </div>
            </div>

            <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Rejestracja</button>
            </div>
            <div class="control">
                <button class="button is-link is-light">Anuluj</button>
            </div>
            </div>
        </form>
		<div><?php if(isset($error)) echo $error; ?></div>
    </div>
</div>
        