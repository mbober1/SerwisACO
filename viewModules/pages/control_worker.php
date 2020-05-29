<?php
require_once $__Includes['WorkerService'];
$service = new WorkerService();
?>

<div class='control'>
    <div class='control_panel' >
        <div><h1>KOLEJKA NAPRAW</h1></div>
        <form method="post" class="carlist"><?php 
			try {
				if (isset($_POST['status1'])) {
					$service->changeStatus($_POST['status1'], 1);
					$db->addLog($_SESSION['user_data']['user_id'], 'change queue status', date('Y-m-d G:i:s'), 1, $_POST['status1']);
				}
				if (isset($_POST['status2'])) {
					$service->changeStatus($_POST['status2'], 2);
					$db->addLog($_SESSION['user_data']['user_id'], 'change queue status', date('Y-m-d G:i:s'), 2, $_POST['status2']);
					$service->startRepair($_POST['status2']);
				}

				if (isset($_POST['status3'])) {
					$service->changeStatus($_POST['status3'], 3);
					$db->addLog($_SESSION['user_data']['user_id'], 'change queue status', date('Y-m-d G:i:s'), 3, $_POST['status3']);
				}
				if (isset($_POST['status4'])) {
					$service->changeStatus($_POST['status4'], 4);
					$db->addLog($_SESSION['user_data']['user_id'], 'change queue status', date('Y-m-d G:i:s'), 4, $_POST['status4']);
				}
				$rows = $service->getQueue();

				while ($row = array_shift($rows)) {
					$car = $service->getCarById($row["car_id"]);
					echo "<div class='carinfo'>";
					echo "<div>Pojazd: <b>", $car["brand"], " ", $car["model"],"</b></div>";
					echo "<div>Nr. VIN: <b>", $car["vin"], "</b></div>";
					echo "<div>Usterki: <b>", $row["failure"],"</b></div>";
					echo "<div>Status: <b>", $status[$row["status"]],"</b></div>";
					echo "<div>Ostatnia status z: <b>", $row["last_modified"],"</b></div>";
					echo '<button type="submit" name="status1" value=', $row['id'] ,' method="post" class="button is-link'; if($row["status"]!=1) echo ' is-light'; echo'">Status "przyjęto" </button></a>';
					echo '<button type="submit" name="status2" value=', $row['id'] ,' method="post" class="button is-link'; if($row["status"]!=2) echo ' is-light'; echo'">Status "w naprawie" </button></a>';
					echo '<button type="submit" name="status3" value=', $row['id'] ,' method="post" class="button is-link'; if($row["status"]!=3) echo ' is-light'; echo'">Status "do odbioru" </button></a>';
					echo '<button type="submit" name="status4" value=', $row['id'] ,' method="post" class="button is-link'; if($row["status"]!=4) echo ' is-light'; echo'">Status "zakończono" </button></a>';
					echo "</div>";

				}
			} catch (\Exception $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
			?>

        </form>
    </div>
</div>