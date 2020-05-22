<?php

if (!isLogged() || getUserPermissions())
	header('Location: index.php?site=queue');
else {
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['carSelect']) && isset($_POST['failure'])) {
			try {
				$query = $service->addToQueue($_POST['carSelect'], $_POST['failure']);
				$queue = $service->getQueue();
				$db->addLog($_SESSION['user_data']['user_id'], 'added to queue', date('Y-m-d G:i:s'), 0, (end($queue))['id']);
				header('Location: index.php?site=queue');
			} catch (Exception $e) {
				$error = 'Wystąpił błąd';
				print_r($e);
			}
		}
	}
}

echo '
<div>
    <div class="tile_main">';

$rows = $service->getCars(getUserID());
if ($rows) {
	echo '
    <form id="addqueue" class="card container" method="post" style="padding: 15px;">
    <div class="field">
        <label class="label">Wybierz auto</label>';

	echo '<select required name="carSelect" class="dropdown-content">';
	while ($row = array_shift($rows))
		echo "<option value=", $row["id"], ">", $row["brand"], " ", $row["model"], " | ", $row["vin"], " </option>";
	echo '</select>
    </div>
    <div class="field">
    <label class="label">Wypisz usterki</label>
	<input class="input" required type="text" name="failure" placeholder="np. auto nie odpala na zmnym">
	</div>

<div class="field is-grouped">
<button class="button is-link">Dodaj</button>
</div>
</form>';
} else {
	echo '<div id="addqueue" class="card container" method="post" style="padding: 15px;">';
	echo "Nie masz dodanych żadnych pojazdów";
	echo '<a href="index.php?site=addcar"><button class="button is-link">Dodaj auto</button></a></div>';
}

echo '</div>
</div>';
?>





