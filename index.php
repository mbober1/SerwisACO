
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
?>
<!doctype html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>SerwisACO - projekt</title>
		<meta name="description" content="SerwisACO">
		<meta name="author" content="Unnamed Group of Deers">

		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/bulma.css">
	</head>

	<body>

		<?php
		include('./viewModules/components/topbar.php');
		include('./viewModules/components/banner.php');
		

		echo "<div id='content'>";

		if (isLogged())
			include('./viewModules/pages/home_logged_in.php');
		else
			include('./viewModules/pages/home.php');

		echo '</div>';
		
		include('./viewModules/components/footer.php')
		?>
		<script async defer src="https://use.fontawesome.com/releases/v5.6.3/js/all.js" integrity="sha384-EIHISlAOj4zgYieurP0SdoiBYfGJKkgWedPHH4jCzpCXLmzVsw1ouK59MuUtP4a1" crossorigin="anonymous"></script>
	</body>
</html>
<?php
ob_end_flush();
