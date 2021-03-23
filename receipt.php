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

<body class="inter bg-gray-600">

    <?php
    // Get the latest booked_flight to display in receipt
    $max = "SELECT MAX(id) as LATEST from booked_flight";
    $max = $conn->query($max)->fetch_assoc();

    // Fetch the booked flight data
    $sql = "SELECT * FROM booked_flight WHERE id={$max['LATEST']}";
    $result = $conn->query($sql)->fetch_assoc();

    // Get the departure time
    $sql = "SELECT * FROM flight_list WHERE id={$result['flight_id']}";
    $time = $conn->query($sql)->fetch_assoc();
    $airline_id = $time['airline_id'];
    $price = $time['price'];
    $departure_date = date('D d M Y', strtotime($time['departure_datetime']));
    $departure_time = date('h:i A', strtotime($time['departure_datetime']));
    $arrival_date = date('D d M Y', strtotime($time['arrival_datetime']));
    $arrival_time = date('h:i A', strtotime($time['arrival_datetime']));

    // Get the airline
    $sql = "SELECT * FROM airlines_list WHERE id=$airline_id";
    $airline = $conn->query($sql)->fetch_assoc();

    // Get the departure and arrival location
    $sql = "SELECT * FROM airport_list WHERE id = {$time['departure_airport_id']}";
    $departure = $conn->query($sql)->fetch_assoc();
    $departure_airport = $departure['airport'];
    $departure_loc = $departure['location'];

    $sql = "SELECT * FROM airport_list WHERE id = {$time['arrival_airport_id']}";
    $arrival = $conn->query($sql)->fetch_assoc();
    $arrival_airport = $arrival['airport'];
    $arrival_loc = $arrival['location'];
    ?>


    <div class="container mx-auto px-4 py-10 space-y-10">
        <div class="bg-white mx-auto rounded-lg shadow-xl flex flex-col justify-center items-center px-5">

            <div class="flex w-full items-center justify-between py-4 px-3 rounded-t-lg justify-between border-b-4 border-yellow-300">
                <div class="flex items-center space-x-2">
                    <a href="#">
                        <img src="assets/Logo.png" alt="Logo" class="w-auto h-16 hover:opacity-75">
                    </a>
                    <h1 class="font-semibold text-2xl tracking-tight">iConnect</h1>
                </div>
                <h1 class="font-bold text-3xl text-yellow-500">Itinerary Receipt</h1>
            </div>

            <div class="flex w-full items-center py-4 px-3 justify-between border-b border-dashed border-black">
                <h1 class="font-semibold text-xl text-blue-500">Booking Details
                    <p class="font-normal text-black text-sm">Passenger Name: <?php echo $result['name']?></p>
                    <p class="font-normal text-black text-sm">Status: Confirmed</p>
                    <p class="font-normal text-black text-sm">Booking date: <?php echo $departure_date?> </p>
                </h1>
                <h1 class=" text-xl">Booking Reference Number: 
                    <p class="font-bold text-center text-xl tracking-wide"><?php echo $result['Flight_Number']?></p>
                </h1>
                <img src="http://bwipjs-api.metafloor.com/?bcid=code128&text=<?php echo $result['Flight_Number']?>&scale=10&includetext" alt="Barcode" class="w-48 h-24">
            </div>

            <div class="flex flex-col w-full py-4 px-3 justify-start border-b-4 border-yellow-300">
                <h1 class="font-semibold text-xl text-blue-500">Guest Details</h1>
                <div class="flex flex-wrap justify-around items-center p-4">
                    <?php
                        $guests = $result['Guest'];
                        for ($i=0; $i < $guests; $i++) { 
                            $num = $i + 1;
                            echo "<p class='font-normal text-black'>$num. Juan Dela Cruz</p>";
                        }
                    ?>
                </div>
            </div>

            <div class="flex flex-col w-full py-4 px-3 justify-start space-y-8 mb-10">
                <h1 class="font-semibold text-xl text-blue-500">Flight Details</h1>
                <table class="w-full table-auto">
                    <thead class="border-b border-dashed border-black">
                        <tr>
                            <th>Route</th>
                            <th>Airline</th>
                            <th>Flight #</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                        </tr>
                    </thead>
                
                    <tbody class="text-center pt-10">
                        <tr>
                            <td><?php echo $departure_airport?> to <?php echo $arrival_airport?></td>
                            <td><?php echo $airline['airlines']?></td>
                            <td><?php echo $result['Flight_Number']?></td>
                            <td><?php echo $departure_date?> , <?php echo $departure_time?></td>
                            <td><?php echo $arrival_date?> , <?php echo $arrival_time?></td>
                        </tr>
                        
                    </tbody>
                
                </table>
                
                <div class="border-4 border-gray-300 p-5 pb-10 space-y-5">
                    <h1 class="font-semibold text-xl text-blue-500 italic">REMINDERS:</h1>
                    <ul class="list-inside list-disc px-8">
                        <li class="italic">Guests needing transfers between Manila’s airport terminals may take the free Manila International Airport Authority shuttle buses. These have regular trips between Terminals 1, 2, 3 and 4. Other terminal transfer options are also available, at a cost.</li>
                    </ul>
                </div>

            </div>


        </div>

        <div class="bg-white mx-auto w-1/3 rounded-lg shadow-xl flex flex-col justify-center items-center py-5">
            <a href="#">
                <img src="assets/Logo.png" alt="Logo" class="w-auto h-16 hover:opacity-75">
            </a>
            <h1 class="font-semibold text-2xl tracking-tight">iConnect</h1>
            <p class="tracking-tight text-center mt-3 mb-3">P. Paredes St, Sampaloc, Manila, 1015 Metro Manila</p>

            <div class="border-b-2 border-t-2 border-gray-200 w-full text-center py-3">
                <h1 class="font-normal text-lg tracking-tight">OFFICIAL RECEIPT</h1>
                <h1 class="font-semibold text-xl tracking-tight">OR No. : <?php echo $result['Flight_Number']?></h1>
            </div>

            <div class="flex justify-around mt-3">
                <h1 class="tracking-tight text-center">Issuing Office: Web</h1>
            </div>

            <div class="flex justify-around">
                <h1 class="tracking-tight text-center">Transaction ID: <?php echo rand(100000, 999999)?></h1>
            </div>

            <div class="flex justify-around">
                <h1 class="tracking-tight text-center">Confirmation Number: <?php echo rand(100000, 999999)?></h1>
            </div>

            <div class="flex justify-around">
                <h1 class="tracking-tight text-center">Date: <?php echo date('n/d/Y', strtotime($time['departure_datetime']))?></h1>
            </div>

            <div class="flex justify-around">
                <h1 class="tracking-tight text-center">Received from: <?php echo $result['name']?></h1>
            </div>

            <div class="flex justify-around">
                <h1 class="tracking-tight text-center">Number of guests: <?php echo $result['Guest']?></h1>
            </div>

            <div class="flex justify-around mb-3">
                <h1 class="tracking-tight text-center">Total amount: P<?php echo $price?></h1>
            </div>

            <div class="border-b-2 border-t-2 border-gray-200 w-full flex flex-col justify-start pl-3 py-3">
                <h1 class="font-normal text-sm tracking-tight">Permit No.: <?php echo rand(100000, 999999)?></h1>
                <h1 class="font-normal text-sm tracking-tight">Date Issued: <?php echo date('M j, Y')?></h1>
            </div>

            <h1 class="font-normal text-sm text-gray-500 tracking-tight mt-3">**** THIS IS A SYSTEM GENERATED OFFICIAL RECEIPT ****</h1>

        </div>
        
    </div>
</body>

</html> 