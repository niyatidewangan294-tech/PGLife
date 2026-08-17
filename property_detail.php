<?php
session_start();
require "includes/database_connect.php";

$property_id = $_GET['property_id'] ?? 0;

// Escape the input variable to guard raw queries
$property_id = mysqli_real_escape_string($conn, $property_id);

$sql = "SELECT * FROM properties WHERE id='$property_id'";
$result = mysqli_query($conn, $sql);
$property = mysqli_fetch_assoc($result);

if($property == null) {
    echo "Property not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $property['name']; ?> | PG Life</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="css/property_detail.css">
</head>

<body>

<?php include "includes/header.php"; ?>

<div class="mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent p-0 mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="property_list.php">Back</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $property['name']; ?></li>
        </ol>
    </nav>
</div>

<div class="main-content mx-auto my-4">
    <div class="container mt-4">
        <div id="property-images" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#property-images" data-slide-to="0" class="active"></li>
                <li data-target="#property-images" data-slide-to="1"></li>
                <li data-target="#property-images" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/properties/1/1d4f0757fdb86d5f.jpg" class="d-block w-100 property-image">
                </div>
                <div class="carousel-item">
                    <img src="img/properties/1/46ebbb537aa9fb0a.jpg" class="d-block w-100 property-image">
                </div>
                <div class="carousel-item">
                    <img src="img/properties/1/eace7b9114fd6046.jpg" class="d-block w-100 property-image">
                </div>
            </div>
            <a class="carousel-control-prev" href="#property-images" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#property-images" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container property-section">
        <div class="d-flex justify-content-between">
            <div>
                <?php for($i = 0; $i < $property['rating']; $i++) { ?>
                    <i class="fas fa-star rating-star"></i>
                <?php } ?>
            </div>

            <div class="interest-container">
                <?php
                $user_id = $_SESSION['user_id'] ?? 0;
                $is_interested = false;

                if ($user_id) {
                    $check_sql = "SELECT * FROM interested_users_properties WHERE user_id=$user_id AND property_id=$property_id";
                    $check_result = mysqli_query($conn, $check_sql);

                    if ($check_result && mysqli_num_rows($check_result) > 0) {
                        $is_interested = true;
                    }
                }
                ?>

                <i id="heart-toggle-btn" 
                   class="<?php echo ($is_interested) ? 'fas' : 'far'; ?> fa-heart heart-icon" 
                   style="cursor: pointer;" 
                   data-property-id="<?php echo $property_id; ?>"></i>

                <span>
                    <span id="interest-count-val">
                    <?php
                    $count_sql = "SELECT COUNT(*) AS total FROM interested_users_properties WHERE property_id = $property_id";
                    $count_result = mysqli_query($conn, $count_sql);
                    $count_row = mysqli_fetch_assoc($count_result);
                    echo $count_row['total'];
                    ?>
                    </span> Interested
                </span>
            </div>
        </div>

        <h2 class="mt-3"><?php echo $property['name']; ?></h2>
        <p><?php echo $property['address']; ?></p>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <div>
                <h3>Rs <?php echo $property['rent']; ?>/-</h3>
                <small>per month</small>
            </div>
            <button class="btn btn-primary">Book Now</button>
        </div>
    </div>

    <div class="container mt-5">
        <h2>Amenities</h2>
        <div class="row mt-4 text-center">
            <div class="col-md-3">
                <img src="img/amenities/wifi.svg" class="amenity-img">
                <p>Wifi</p>
            </div>
            <div class="col-md-3">
                <img src="img/amenities/bed.svg" class="amenity-img">
                <p>Bed</p>
            </div>
            <div class="col-md-3">
                <img src="img/amenities/ac.svg" class="amenity-img">
                <p>AC</p>
            </div>
            <div class="col-md-3">
                <img src="img/amenities/washingmachine.svg" class="amenity-img">
                <p>Washing Machine</p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2>About the Property</h2>
        <p class="mt-3"><?php echo $property['description']; ?></p>
    </div>

    <div class="container property-rating">
        <h2>Property Rating</h2>
        <div class="row mt-4 align-items-center">
            <div class="col-md-6">
                <p><i class="fas fa-broom"></i> Cleanliness
                    <span class="ml-3">
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                    </span>
                </p>
                <p><i class="fas fa-utensils"></i> Food Quality
                    <span class="ml-3">
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                    </span>
                </p>
                <p><i class="fas fa-lock"></i> Safety
                    <span class="ml-3">
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                        <i class="fas fa-star rating-star"></i>
                    </span>
                </p>
            </div>
            <div class="col-md-4 offset-md-2 text-center">
                <div class="rating-circle">
                    <h1><?php echo $property['rating']; ?></h1>
                    <?php for($i = 0; $i < $property['rating']; $i++) { ?>
                        <i class="fas fa-star"></i>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container what-people">
        <h2>What people say</h2>
        <div class="testimonial-box">
            <img src="img/man.png" class="testimonial-img">
            <p>You just have to arrive at the place, it's fully furnished and stocked with amenities.</p>
            <h5>- Ashutosh Gowariker</h5>
        </div>
        <div class="testimonial-box">
            <img src="img/man.png" class="testimonial-img">
            <p>Very clean and comfortable environment with friendly roommates.</p>
            <h5>- Karan Johar</h5>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/property_detail.js"></script>

<script>
$(document).ready(function() {
    $('#heart-toggle-btn').click(function() {
        const propertyId = $(this).attr('data-property-id');
        const heartIcon = $(this);
        const countSpan = $('#interest-count-val');

        // Redirect instantly if user profile is absent
        const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        if (!isLoggedIn) {
            window.location.href = "login.php";
            return;
        }

        // We use the toggle endpoint we created for the React component!
        $.ajax({
            url: 'api/toggle_interested.php',
            type: 'GET',
            data: { property_id: propertyId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let currentCount = parseInt(countSpan.text());
                    
                    if (response.is_interested) {
                        // Change icon to solid heart and increase counter
                        heartIcon.removeClass('far').addClass('fas');
                        countSpan.text(currentCount + 1);
                    } else {
                        // Change icon to empty heart and decrease counter
                        heartIcon.removeClass('fas').addClass('far');
                        countSpan.text(currentCount - 1);
                    }
                } else if (response.is_logged_in === false) {
                    window.location.href = "login.php";
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", error);
            }
        });
    });
});
</script>

</body>
</html>