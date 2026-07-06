
<?php
require 'header.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodDeliveryApp</title>
</head>
<body>
    <main id="main_content_container">
        
        <div id="address_search_container">
            <!-- search input, search button, track location button -->
             <div id="input">
                <input type="text" id="location" name="location" value="" placeholder="Enter your address, city, or postal code"/>
            </div>
            <div id="buttons">
                <button type="submit" class="search_btn"> Search Restaurants</button>
                <button type="button" class="location_btn" onclick="getLocation()"> Use My Location</button>
            </div>
        </div>

        <div id="map">
        </div>
        <script src="user_location.js"></script>

        <div class="restaurants">
            <h2>Explore local restaurants</h2>
            <ul>
                <li>
                    <h3><a href="restaurants.php">Burger King</a></h3>
                    <p>Best deals on burger combos</p>
                </li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>

    </main>

</body>
</html>

<?php
require 'footer.php';

?>