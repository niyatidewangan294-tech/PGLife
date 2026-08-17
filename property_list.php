<?php
session_start();
require "includes/database_connect.php";

$city = $_GET['city'] ?? '';

if ($city == '') {
    echo "City not provided";
    exit;
}

$city_sql = "SELECT id FROM cities WHERE name='$city'";
$city_result = mysqli_query($conn, $city_sql);

$city_row = mysqli_fetch_assoc($city_result);

if ($city_row == null) {
    echo "City not found";
    exit;
}

$city_id = $city_row['id'];

$sql = "SELECT * FROM properties WHERE city_id='$city_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Best PG's in <?php echo $city; ?> | PG Life</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/property_list.css">
<link href="static/css/main.c168f0d0.css" rel="stylesheet">
    

</head>

<body>

<?php include "includes/header.php"; ?>                                     


<nav aria-label="breadcrumb">

    <ol class="breadcrumb py-2">

        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>

        <li class="breadcrumb-item active">
            <?php echo $city; ?>
        </li>

    </ol>

</nav>

 <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
    




<?php
include "includes/signup_modal.php";
include "includes/login_modal.php";
include "includes/footer.php";
?>

<script defer="defer" src="static/js/main.f78036ce.js"></script>
 


</body>

</html>