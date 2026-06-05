
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
    <main id="main-content-container">
        <div id="address-search-container">
            <!-- search input, search button, track location button -->
             <div id="input">
                <input type="text" id="location" name="location" value="" placeholder="Enter your address, city, or postal code"/>
            </div>
            <div id="buttons">
                <button type="submit" class="search-btn"> Search Restaurants</button>
                <button type="button" class="location-btn" onclick="getLocation()"> Use My Location</button>
            </div>
        </div>

        <div id="map">

        </div>
        <script>
            function getLocation(){
                document.getElementById("address-search-container").style.display = "none";

                navigator.geolocation.getCurrentPosition(position => {
                const { latitude, longitude } = position.coords;
                // Show a map centered at latitude / longitude.
                map.innerHTML = '<iframe width="700" height="300" src="https://maps.google.com/maps?q='+latitude+','+longitude+'&amp;z=15&amp;output=embed"</iframe>' 
                }); 
            }   
        </script>

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
    <main>

</body>
</html>

<?php
require 'footer.php';

?>