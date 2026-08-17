<?php

session_start();

if(!isset($_SESSION['user_id'])) {
    header("location: index.php");
    exit;
}

require "includes/database_connect.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$interest_sql = "SELECT p.*
FROM properties p
INNER JOIN interested_users_properties i
ON p.id = i.property_id
WHERE i.user_id = $user_id";

$interest_result = mysqli_query($conn, $interest_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | PG Life</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">

</head>

<body>

<?php include "includes/header.php"; ?>

<div class="container-fluid bg-light py-2">
    <a href="index.php">Home</a> / Dashboard
</div>

<div class="container mt-5">

    <h2 class="mb-4">Profile Information</h2>

    <div class="row profile-section align-items-center">

        <div class="col-md-3 text-center">
            <i class="fas fa-user-circle user-icon"></i>
        </div>

        <div class="col-md-9">
            <h4><?php echo $user['full_name']; ?></h4>
            <p>Email : <?php echo $user['email']; ?></p>
            <p>Phone : <?php echo $user['phone']; ?></p>
            <p>College : <?php echo $user['college_name']; ?></p>
        </div>

    </div>

</div>

<div class="container mt-5">

    <h2 class="mb-4">Interested Properties</h2>

    <?php if(!$interest_result || mysqli_num_rows($interest_result) == 0) { ?>

        <p style="color: gray;">You have not marked any properties as interested yet.</p>

    <?php } else { ?>

        <?php while($row = mysqli_fetch_assoc($interest_result)) { ?>

        <div class="property-box row mb-4">

            <div class="col-md-4">

                <img src="img/properties/1/1d4f0757fdb86d5f.jpg"
                     class="img-fluid room-img">

            </div>

            <div class="col-md-8">

                <div class="d-flex justify-content-between">

                    <div>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                    <div>
                        <a href="api/interested_delete.php?property_id=<?php echo $row['id']; ?>"
                           class="interest-toggle"
                           data-property-id="<?php echo $row['id']; ?>"
                           style="color:red; text-decoration:none;">
                            <i class="fas fa-heart" style="color:red;"></i>
                        </a>
                    </div>

                </div>

                <h4 class="mt-3">
                    <?php echo $row['name']; ?>
                </h4>

                <p>
                    <?php echo $row['address']; ?>
                </p>

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5>Rs. <?php echo $row['rent']; ?></h5>
                        <small>per month</small>
                    </div>

                    <a href="property_detail.php?property_id=<?php echo $row['id']; ?>"
                       class="btn btn-primary">

                        Explore

                    </a>

                </div>

            </div>

        </div>

        <?php } ?>

    <?php } ?>

</div>

<?php include "includes/footer.php"; ?>

</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="js/dashboard.js"></script>

</body>

</html>








    