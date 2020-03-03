<?php 
include_once 'db.php';
include_once 'services/users.php';
include_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database($db_address, $db_user, $db_password, $db_name);
    $service = new UsersService($database);

    if (isset($_POST['email']) && isset($_POST['password'])) {
        try {
            $user = $service->getUser($_POST['email']);
            // $hash = password_hash($password, PASSWORD_DEFAULT);
            if ($user['password'] === $_POST['password']) {
                // print_r("WITAJ URŻYTKOWNIKU");
                $_SESSION['logged'] = true;
                header('Location: index.php');
            }
            else throw new Exception('Not found');
        }
        catch (Exception $e){
            print('Nieprawidłowy email lub hasło');
        }
    }
}

?>

<form id="login" class="card container" method="post">
<div class="field">
<p class="control has-icons-left has-icons-right">
    <input class="input" type="email" placeholder="Email" name="email">
    <span class="icon is-small is-left">
    <i class="fas fa-envelope"></i>
    </span>
    <span class="icon is-small is-right">
    <i class="fas fa-check"></i>
    </span>
</p>
</div>
<div class="field">
<p class="control has-icons-left">
    <input class="input" type="password" placeholder="Password" name="password">
    <span class="icon is-small is-left">
    <i class="fas fa-lock"></i>
    </span>
</p>
</div>
<div class="field">
<p class="control">
    <button class="button is-success">
    Zaloguj
    </button>
</p>
</div>
</form>