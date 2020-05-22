<?php
require $__Includes['AdminService'];
$service = new AdminService();
?>

<div class='control'>
    <div class='control_panel' >
        <div><h1>Użytkownicy</h1></div>
        <form method="post" class="carlist"><?php
			try {
				if (isset($_POST['admin_status1']))
					$service->changeUserPermission($_POST['admin_status1'], 0);
				if (isset($_POST['admin_status2']))
					$service->changeUserPermission($_POST['admin_status2'], 1);
				if (isset($_POST['admin_status3']))
					$service->changeUserPermission($_POST['admin_status3'], 2);
				$rows = $service->getUsers();

				while ($row = array_shift($rows)) {
					echo "<div class='carinfo'>";
					echo "<div>", $row["firstname"], " ", $row["lastname"], "</div>";
					echo "<div>Status: <span class=\"success\">";
					if ($row['permission'] == 0)
						echo "Klient";
					else
					if ($row['permission'] == 1)
						echo "Mechanik";
					else
						echo "Admin";
					echo "</span></div>";
					if ($row['permission'] != 0)
						echo '<button type="submit" name="admin_status1" value=', $row['id'], ' method="post" class="button is-link is-light">Zmień na klienta </button>';
					if ($row['permission'] != 1)
						echo '<button type="submit" name="admin_status2" value=', $row['id'], ' method="post" class="button is-link is-light">Zmień na mechanika </button>';
					if ($row['permission'] != 2)
						echo '<button type="submit" name="admin_status3" value=', $row['id'], ' method="post" class="button is-link">Zmień na administratora </button>';
					echo "</div>";
				}
			} catch (\Exception $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
			?>

        </form>
    </div>


    <div class='control_panel' >
        <div><h1>Logi</h1></div>
        <form method="post"><?php
			try {
				$rows = $service->getLog();

				while ($row = array_shift($rows)) {
					echo "<div class='carinfo'>";
					echo "<div>", $row["action_title"], " ", $row["origin"], "</div>";
					echo "<div>", $row["action_description"], "</div>";
					echo "</div>";
				}
			} catch (\Exception $e) {
				echo 'ERROR: ' . $e->getMessage();
			}
			?>

        </form>
    </div>
</div>
