<div>
    <div class='control'>
        <div class='control_panel style="width: 47%;"' >
            <div><h1>TWOJE AUTA</h1></div>
            <div class='carlist'>
                <?php 
                    $rows = $service->getCars(getUserID());
                    if($rows) {
                        while ($row = array_shift($rows)) {
                            echo "<div class='carinfo'>";
                            echo "<div>Marka: ", $row["brand"],"</div>";
                            echo "<div>Model: ", $row["model"],"</div>";
                            echo "<div>Nr VIN: ", $row["vin"],"</div>";
                            echo "<div>Moc: ", $row["power"],"KM</div>";
                            echo "<div>Przebieg: ", $row["mileage"],"km</div>";
                            echo "<div>Pojemność silnika: ", $row["engine_capacity"],"cm³</div>";
                            echo "<div>Paliwo: ", $row["fuel"],"</div>";
                            echo "<div>Kolor: ", $row["body_color"],"</div>";
                            echo "<div>Ilość drzwi: ", $row["number_doors"],"</div>";
                            echo "</div>";
                        }
                    } else echo "Nie masz zapisanych żadnych pojazdów";
                    
                    ?>
            </div>
            <a href="index.php?site=addcar"><button class="button is-link">Dodaj auto</button></a>
        </div>
        <div class='control_panel' >
            <div><h1>TWOJE ZGŁOSZENIA NAPRAWY</h1></div>
            <div class='carlist'>
                <?php 
                $rows = $service->checkMyQueue(getUserID());
                if($rows) {
                    while ($row = array_shift($rows)) {
                        $car = $service->carInfo($row["car_id"]);
                        echo "<div class='carinfo'>";
                        echo "<div>Pojazd: ", $car["brand"], " ", $car["model"],"</div>";
                        echo "<div>Usterki: ", $row["failure"],"</div>";
                        echo "<div>Status: ", $status[$row["status"]],"</div>";
                        echo "<div>Ostatnia status z: ", $row["last_modified"],"</div>";
                        echo "<div>Rozpoczęto naprawę: ", $row["start_repair_date"],"</div>";
                        echo "</div>";
                    }
                } else echo "Nie masz żadnych aktualnych napraw";?>
            </div>
            <a href="index.php?site=addqueue"><button class="button is-link">Dodaj auto do kolejki</button></a>
        </div>
    </div>
</div>
