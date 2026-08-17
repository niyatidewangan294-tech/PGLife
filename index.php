<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | PG Life</title>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/home.css" rel="stylesheet">


</head>
<body>

<?php include "includes/header.php"; ?>

    <div id="Loading">
    </div>
    <div class="banner-container">
    <h2 class="pb-3">Happiness per Square Foot</h2>

    <form id="search-form" method="get" action="property_list.php">
        <div class="input-group city-search">
            <input type="text"
       class="form-control"
       name="city"
       placeholder="Enter your city to search for PGs">
            <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Search
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<div class="container mt-5">
    <h1 class="text-center mb-4">Major Cities</h1>

    <div class="row text-center">
        <div class="col-md">
            <div class="city-card ">
            <a href="property_list.html">
            <img src="img/delhi.png" class="city-img img-fluid " alt="Delhi">
            </a>
            </div>
            <p class="mt-2">Delhi</p>
        </div>

        <div class="col-md">
            <div class="city-card ">
            <a href="property_list.html">
            <img src="img/mumbai.png" class="city-img img-fluid " alt="Mumbai">
            </a>
            </div>
            <p class="mt-2">Mumbai</p>
        </div>

        <div class="col-md">
            <div class="city-card ">
            <a href="property_list.html">
            <img src="img/bangalore.png" class="city-img img-fluid " alt="Bangalore">
            </a>
            </div>
            <p class="mt-2">Bangalore</p>
        </div>

        <div class="col-md">
            <div class="city-card ">
            <a href="property_list.html">
            <img src="img/hyderabad.png" class="city-img img-fluid " alt="Hyderabad">
            </a>
            </div>
            <p class="mt-2">Hyderabad</p>
        </div>
    </div>
</div>


<?php include "includes/signup_modal.php"; ?>

<?php include "includes/login_modal.php"; ?>

<?php include "includes/footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>