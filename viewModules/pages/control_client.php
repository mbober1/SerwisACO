<div class='control'>
    <div class='control_panel' >
        <div><h1>TWOJE AUTA</h1></div>
        <div class='carlist'><?php $rows = $service->getCars(getUserID());
                while ($row = array_shift($rows)) {
                    echo "<div class='carinfo'>";
                    echo "<div>Marka: ", $row["brand"],"</div>";
                    echo "<div>Model: ", $row["model"],"</div>";
                    echo "<div>Nr VIN: ", $row["vin"],"</div>";
                    echo "<div>Moc: ", $row["power"],"KM</div>";
                    echo "<div>Przebieg: ", $row["mileage"],"km</div>";
                    echo "</div>";
                }?>
        </div>
        <div class="control"><a href="index.php?site=addcar"><button class="button is-link">Dodaj auto</button></a></div>
    </div>
    <div class='control_panel' >
        <div><h1>TWOJE ZGŁOSZENIA NAPRAWY</h1></div>
        <div class='carlist'><?php $rows = $service->checkMyQueue(getUserID());
                while ($row = array_shift($rows)) {
                    $car = $service->carInfo($row["carid"]);
                    echo "<div class='carinfo'>";
                    echo "<div>Pojazd: ", $car["brand"], " ", $car["model"],"</div>";
                    echo "<div>Usterki: ", $row["failure"],"</div>";
                    echo "<div>Status: ", $status[$row["status"]],"</div>";
                    echo "<div>Ostatnia status z: ", $row["timestamp"],"</div>";
                    echo "</div>";
                }?>
        </div>
        <div class="control"><a href="index.php?site=addqueue"><button class="button is-link">Dodaj auto do kolejki</button></a></div>
    </div>
</div>
