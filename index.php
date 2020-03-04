
<?php
include './config/system_config.php';
session_start();
ob_start();

require $__Includes['DBClient'];
try {
//	$db = new DBClient();
//	echo 'Successfuly connected to Database!';
} catch (PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();
}
if (!isset($_GET['site'])) $_GET['site'] = 'home';
switch($_GET['site']) {
	case "queue":
		$title = "Kolejka";
		$view = ('./viewModules/pages/queue.php');
		break;

	case "signup":
		$title = "Rejestracja";
		$view = ('./viewModules/pages/signup.php');
		break;
	
	case "signin":
		$title = "Logowanie";
		$view = ('./viewModules/pages/signin.php');
		break;

	case "logout":
		$title = "Wylogowanie";
		$view = ('./viewModules/pages/logout.php');
		break;
	
	case "addcar":
		$title = "Dodawanie auta";
		$view = ('./viewModules/pages/add_car.php');
		break;

	default:
		$title = "Home";
		$view = ('./viewModules/pages/home.php');
		break;
}


		// if (isLogged())
		// 	include('./viewModules/pages/home_logged_in.php');
		// else {
			
		// }
		// 	include('./viewModules/pages/home.php');
?>
<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SerwisACO - <?php echo $title ?></title>
		<meta name="description" content="SerwisACO">
		<meta name="author" content="Unnamed Group of Deers">

		
		<link rel="stylesheet" href="css/bulma.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>

	<body>

		<?php
		include('./viewModules/components/topbar.php');
		include('./viewModules/components/banner.php');
	
		echo "<div id='content'>";
		include($view);
		echo '</div>';
		
		include('./viewModules/components/footer.php')
		?>

		<script async defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1" crossorigin="anonymous"></script>
	</body>
</html>
<?php
ob_end_flush();
