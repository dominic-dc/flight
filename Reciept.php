<!DOCTYPE html>
<html lang="en">
<?php include 'admin/db_connect.php' ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .logo {
            width: 250px;
            height: 120px;
        }

        .logoimage {
            width: 100%;
            height: auto;
        }

        .center {
            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 3rem;
            color: black;

            font-family: "Open Sans", sans-serif;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="center">
        <div class="logo">
            <img src="assets/Logo.png" alt="" class="logoimage">
            <br>
            <div class="center">iConnect</div>
        </div>
    </div>
    <?php
    $sql = "SELECT flight_id, name , address, contact, guest FROM booked_flight WHERE id='2'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "id: " . $row["flight_id"]. " - Name: " . $row["name"]. " " . $row["address"]. "<br>";
      }
    } else {
      echo "0 results";
    }
    $conn->close();
    ?>
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

</body>

</html>