<div class='control'>
    <div class='control_panel' >
        <div><h1>KOLEJKA NAPRAW</h1></div>
        <form method="post" class='carlist'><?php 
        try {
            if (isset($_POST['status1'])) $service->changeStatus($_POST['status1'], 1);
            if (isset($_POST['status2'])) $service->changeStatus($_POST['status2'], 2);
            if (isset($_POST['status3'])) $service->changeStatus($_POST['status3'], 3);
            if (isset($_POST['status4'])) $service->changeStatus($_POST['status4'], 4);
            $rows = $service->getQueue();
            while ($row = array_shift($rows)) {
                $car = $service->carInfo($row["carid"]);
                echo "<div class='carinfo'>";
                echo "<div>Pojazd: ", $car["brand"], " ", $car["model"],"</div>";
                echo "<div>Nr. VIN: ", $car["vin"], "</div>";
                echo "<div>Usterki: ", $row["failure"],"</div>";
                echo "<div>Status: ", $status[$row["status"]],"</div>";
                echo "<div>Ostatnia status z: ", $row["timestamp"],"</div>";
                echo '<button type="submit" name="status1" value=', $row['id'] ,' method="post" class="button is-link is-light">Status "przyjęto" </button></a>';
                echo '<button type="submit" name="status2" value=', $row['id'] ,' method="post" class="button is-link is-light">Status "w naprawie" </button></a>';
                echo '<button type="submit" name="status3" value=', $row['id'] ,' method="post" class="button is-link is-light">Status "do odbioru" </button></a>';
                echo '<button type="submit" name="status4" value=', $row['id'] ,' method="post" class="button is-link ">Status "zakończono" </button></a>';
                echo "</div>";
            }
        
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }?>

        </form>
    </div>
    <div class='control_panel' >
    </div>
</div>