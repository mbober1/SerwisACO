<?php

echo "
<div class='background'>
	<div class='tile_main'>
		<h1>KOLEJKA NAPRAW</h1>";

try {
	$rows = $service->getQueue();
	while ($row = array_shift($rows)) {
		$car = $service->carInfo($row['carid']);
		echo "<div class='queue'>";
		echo "<div>", $car['brand']," ", $car['model'] , "</div>";
		echo "<div>Aktualizacja: ", $row['timestamp'] , "</div>";
		echo "<div>| Status: ", $status[$row["status"]] , "</div>";
		echo "</div>";
	}

} catch (PDOException $e) {
	echo 'ERROR: ' . $e->getMessage();
}


if(isLogged()) echo'<div class="control"><a href="index.php?site=addqueue"><button class="button is-link">Dodaj auto do kolejki</button></a></div>';

echo'
	</div>
</div>';

