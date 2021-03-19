<!DOCTYPE html>
<html lang="en">
<?php include 'admin/db_connect.php';?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
.inter{
    font-family: 'Inter', sans-serif;
}
</style>
</head>

<body class="inter">

    <?php
    // Get the latest booked_flight to display in receipt
    $max = "SELECT MAX(id) as LATEST from booked_flight";
    $max = $conn->query($max);
    $max = $max->fetch_assoc();

    // Fetch the booked flight data
    $sql = "SELECT * FROM booked_flight WHERE id={$max['LATEST']}";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    // Get the departure time
    $sql = "SELECT * FROM flight_list WHERE id={$result['flight_id']}";
    $time = $conn->query($sql);
    $time = $time->fetch_assoc();
    $date = date('M d, Y', strtotime($time['departure_datetime']));
    $boarding_time = date('h:i A', strtotime($time['departure_datetime']));

    // Get the departure and arrival location
    $sql = "SELECT airport FROM airport_list WHERE id = {$time['departure_airport_id']}";
    $departure = $conn->query($sql);
    $departure = $departure->fetch_assoc();
    $departure = $departure['airport'];

    $sql = "SELECT airport FROM airport_list WHERE id = {$time['arrival_airport_id']}";
    $arrival = $conn->query($sql);
    $arrival = $arrival->fetch_assoc();
    $arrival = $arrival['airport'];
    ?>


    <div class="container mx-auto px-4 py-10">
        <div class="bg-gray-100 mx-auto w-3/4 rounded-lg shadow-xl flex flex-col justify-center items-center">

            <div class="flex w-full items-center py-4 px-3 rounded-t-lg justify-between bg-blue-300">
                <a href="#">
                    <img src="assets/Logo.png" alt="Logo" class="w-auto h-16">
                </a>
                <h1 class="font-semibold text-2xl tracking-tight">iConnect</h1>
                <h1 class="font-bold text-3xl tracking-tight">BOARDING PASS</h1>
            </div>

            <div class="flex w-full items-center py-4 px-3 justify-between">
                <h1 class="font-semibold text-xl">Name of Passenger: <p class="font-normal text-lg"><?php echo $result['name'] ?></p></h1>
                <h1 class="font-semibold text-xl">Number of Guest: <p class="font-normal text-lg"><?php echo $result['Guest']?></p></h1>
                <h1 class="font-semibold text-xl">Flight No: <p class="font-normal text-lg"><?php echo $result['Flight_Number']?></p></h1>
            </div>

            <div class="flex w-full items-center py-4 px-3 justify-between">
                <div class="flex flex-col">
                    <h1 class="font-semibold text-xl">From: <p class="font-normal text-lg"><?php echo $departure?></p></h1>
                    <h1 class="font-semibold text-xl">To: <p class="font-normal text-lg"><?php echo $arrival?></p></h1>
                </div>
                <h1 class="font-semibold text-xl">Date: <p class="font-normal text-lg"><?php echo $date?></p></h1>
                <h1 class="font-semibold text-xl">Boarding Time: <p class="font-normal text-lg"><?php echo $boarding_time?></p></h1>
            </div>

            <div class="bg-blue-300 rounded-b-lg p-4 w-full"></div>


        </div>

    <!-- <tr>
        <td><?php echo $i++ ?></td>
        <td>
            <p>Name :<b><?php echo $row['name'] ?></b></p>
            <p><small>Contact # :<b><?php echo $row['contact'] ?></small></b></p>
            <p><small>Address :<b><?php echo $row['address'] ?></small></b></p>
        </td>
        <td>
            <div class="row">
                <div class="col-sm-4">
                    <img src="../assets/img/<?php echo $row['logo_path'] ?>" alt="" class="btn-rounder badge-pill">
                </div>
                <div class="col-sm-6">
                    <p>Airline :<b><?php echo $row['airlines'] ?></b></p>
                    <p><small>Plane :<b><?php echo $row['plane_no'] ?></small></b></p>
                    <p><small>Airline :<b><?php echo $row['airlines'] ?></small></b></p>
                    <p><small>Number Of Guest :<b><?php echo $row['Guest'] ?></small></b></p>
                    <p><small>Location :<b><?php echo $aname[$row['departure_airport_id']] . ' - ' . $aname[$row['arrival_airport_id']] ?></small></b></p>
                    <p><small>Departure :<b><?php echo date('M d,Y h:i A', strtotime($row['departure_datetime'])) ?></small></b></p>
                    <p><small>Arrival :<b><?php echo date('M d,Y h:i A', strtotime($row['arrival_datetime'])) ?></small></b></p>
                </div>
            </div>
        </td>
    </tr> -->
    </div>
</body>

</html> 