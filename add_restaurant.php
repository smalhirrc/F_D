<?php

require 'header.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add store</title>
</head>
<body>
    <main>
        <div id="add-store-main-content-container">
            <div id="add-store-form-container" class="child-box">
                <form id="add-store-form" action="#" method="post">
                    <fieldset>
                        <legend>Primary Contact Info</legend>
                        <ul>
                            <li>
                                <label for="store-owner-first-name">First Name</label>
                                <input type="text" id="store-owner-first-name" name="store-owner-first-name">
                            </li>
                            <li>
                                <label for="store-owner-last-name">Last Name</label>
                                <input type="text" id="store-owner-last-name" name="store-owner-last-name">
                            </li>
                            <li>
                                <label for="store-business-email">Business email</label>
                                <input type="email" id="store-business-email" name="store-business-email">
                            </li>
                            <li>
                                <label for="store-phone-number">Phone</label>
                                <div id="store-phone-number-input-container">
                                    <select id="store-country-code" name="store-country-code">
                                        <option value="+1">Canada (+1)</option>
                                    </select>
                                    <input type="tel" id="store-phone-number" name="store-phone-number">
                                </div>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <legend>Store details</legend>
                        <ul>
                            <li>
                                <label for="store=name">Store Name</label>
                                <input type="text" id="store-name" name="store-name">
                            </li>
                            <li>
                                <label for="store-type">Store type</label>
                                <select id="store-type" name="store-type">
                                    <option value="restaurant">Restaurant</option>
                                    <option value="grocery-store">Grocery Store<option>
                                    <option value="convenience-store">Convenience Store</option>
                                </select>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <legend>Store Address</legend>
                        <ul>
                            <li>
                                <label for="store-street-address">Street Address</label>
                                <input type="text" id="store-street-address" name="store-street-address">
                            </li>
                            <li>
                                <label for="store-suite">Apt., Suite, Unit (Optional)</label>
                                <input type="text" id="store-suite" name="store-suite">
                            </li>
                            <li>
                                <label for="store-city">City</label>
                                <input type="text" id="store-city" name="store-city">
                            </li>
                            <li>
                                <label for="store-province">Province</label>
                                <select id="store-province" name="store-province">
                                    <option value="manitoba">Manitoba</option>
                                </select>
                            </li>
                        </ul>
                    </fieldset>
                    <button type="submit" id="submit">Submit</button>
                </form>
            </div>
            <div id="add_restaurant_page_side_image_container" class="child-box">
            <img id="add_restaurant_page_side_image" src="images/add_restaurant_page_side_image.jpeg" alt="add restaurant">
            </div>
        </div>
    </main>
    <script src="add_restaurant.js"></script>
</body>
</html>