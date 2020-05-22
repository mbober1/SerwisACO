<?php
if(isLogged()) {
	echo "
	<div class='background'>
	<div>
    <div class='control'>
        <div class='control_panel' >
			<h1>KOLEJKA NAPRAW</h1>";
	
	try {
		$rows = $service->getQueue();
		while ($row = array_shift($rows)) {
			$car = $service->carInfo($row['car_id']);
			echo "<div class='carinfo'>";
			echo "<div class=''><b>", $car['brand']," ", $car['model'] , "</b></div>";
			echo "<div class=''>Aktualizacja: <b>", $row['last_modified'] , "</b></div>";
			echo "<div class=''> Status: <b>", $status[$row["status"]] , "</b></div>";
			echo "</div>";
		}
	
	} catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
	
	
	if(!getUserPermissions()) echo'<a href="index.php?site=addqueue"><button class="button is-link">Dodaj auto do kolejki</button></a>';
	else echo'<a href="index.php?site=control"><button class="button is-link">Zarządzaj kolejką</button></a>';
	
	echo'
		</div></div></div>
	</div>';
} else header('Location: index.php');


