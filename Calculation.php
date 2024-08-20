<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Calculate</title>

<style>
    table {
        font-family: arial, sans-serif;
        width: 100%;
    }

    td, th {
        border-bottom: 1px solid ;
        border-bottom-color: grey;
        text-align: left;
        padding: 5px;
    }

</style>

</head>
<body>
    <div class="container mt-5">
        <h1>Calculate</h1>
        <br>
        <form method="post">
            <div class="form-group">
                <label for="voltage">Voltage (V):</label>
                <input type="number" step = "any" class="form-control"   id="voltage" name="voltage" required>
            </div>
            <div class="form-group">
                <label for="current">Current (A):</label>
                <input   type="number" step = "any" class="form-control" id="current" name="current"   required>
            </div>
            <div class="form-group">
                <label for="rate">Current Rate (sen/kWh):</label>
                <input type="number" step = "any" class="form-control" id="crate" name="crate" required>
            </div>
            <button type="submit" step = "any" class="btn btn-primary">Calculate</button>
        </form>
    </div>

    <div class="container mt-5">

      <?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $voltage = isset($_POST['voltage']) && is_numeric($_POST['voltage']) ? floatval($_POST['voltage']) : 0;
    $current = isset($_POST['current']) && is_numeric($_POST['current']) ? floatval($_POST['current']) : 0;
    $crate = isset($_POST['crate']) && is_numeric($_POST['crate']) ? floatval($_POST['crate']) : 0;

    
    function calculatepowerandcost($voltage, $current, $crate)
    {
        if ($voltage > 0 && $current > 0 && $crate > 0) {

        $power = $voltage * $current;

        $powerKW = $power /1000;
        $rate = $crate / 100;

        echo "<p>POWER: $powerKW  kw</p>";
        echo "<p>RATE: $rate RM</p><br>";

        echo "<table>";
        echo "<tr><th>#</th><th>Hour</th><th>Energy(kWh)</th><th>TOTAL(RM)</th></tr>";


        for ($hours=1; $hours <=24 ; $hours++) 
        {       

        $energy = $power * $hours * 1000;
        $total = $energy * ($crate / 100);

        $totalC = $total / 1000000;
        $energyC = $energy / 1000000; 

        echo "<tr>";
        echo "<td><b>$hours</td>";
        echo "<td>$hours</td>";
        echo "<td>$energyC</td>";
        echo "<td>" . number_format($totalC, 2) . "</td>";
        echo "</tr>";

        }

        echo "</table>";

        }       

        else {

            echo "<p>Please enter values for voltage, current, and rate.</p>";
        }    
    }

    calculatepowerandcost($voltage, $current, $crate);    

}

?>

</div>    
</body>
</html>
