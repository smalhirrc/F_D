<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

require 'header.php';
require 'databaseconnect.php';

$store_owner_first_name = isset($_POST['store_owner_first_name']) ? trim($_POST['store_owner_first_name']) : "";
$store_owner_last_name = isset($_POST['store_owner_last_name']) ? trim($_POST['store_owner_last_name']) : "";
$store_business_email = isset($_POST['store_business_email']) ? trim($_POST['store_business_email']) : "";
$store_phone_country_code = isset($_POST['store_phone_country_code']) ? trim($_POST['store_phone_country_code']) : "";
$store_phone_number = isset($_POST['store_phone_number']) ? trim($_POST['store_phone_number']) : "";

$store_name = isset($_POST['store_name']) ? trim($_POST['store_name']) : "";
$store_type = isset($_POST['store_type']) ? trim($_POST['store_type']) : "";

$store_street_address = isset($_POST['store_street_address']) ? trim($_POST['store_street_address']) : "";
$store_unit_number = isset($_POST['store_unit_number']) ? trim($_POST['store_unit_number']) : "";
$store_city = isset($_POST['store_city']) ? trim($_POST['store_city']) : "";
$store_province = isset($_POST['store_province']) ? trim($_POST['store_province']) : "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // VALIDATE INPUTS
    $validated_store_owner_first_name = filter_var($store_owner_first_name, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-zA-Z\s'.-]{1,50}$/"]]);
    $validated_store_owner_last_name = filter_var($store_owner_last_name, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-zA-Z\s'-]{1,50}$/"]]);
    $validated_store_business_email = filter_var($store_business_email, FILTER_VALIDATE_EMAIL);
    $validated_store_phone_country_code = filter_var($store_phone_country_code, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/\+[0-9]{1,4}/"]]);
    $validated_store_phone_number = filter_var($store_phone_number, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^\(?[0-9]{3}\)?[-.( ]?[0-9]{3}[-.)( ]?[0-9]{4}\)?$/"]]);

    // echo "FirstName: ". $validated_store_owner_first_name ."<br>";
    // echo "LastName: ". $validated_store_owner_last_name ."<br>";
    // echo "Email: ". $validated_store_business_email ."<br>";
    // echo "Phone country code: ". $validated_store_phone_country_code ."<br>";
    // echo "PhoneNumber: ". $validated_store_phone_number ."<br>";


    $validated_store_name = filter_var($store_name, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-zA-Z0-9\s.'&-]+$/"]]);
    $validated_store_type = filter_var($store_type, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-zA-Z\s.-]+$/"]]);

    // echo "Store Name: " . $validated_store_name . "<br>";
    // echo "Store type: " . $validated_store_type . "<br>";

    $validated_store_street_address = filter_var($store_street_address, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[0-9a-zA-Z\s'.&,-]+$/"]]);
    $validated_store_unit_number = filter_var($store_unit_number, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[0-9a-zA-Z\s,()#.-]+$/"]]);
    $validated_store_city = filter_var($store_city, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-zA-Z\s'.,()-]+$/"]]);
    $validated_store_province = filter_var($store_province, FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-zA-Z\s'.,()-]+$/"]]);

    // echo "Store street address: " . $validated_store_street_address . "<br>";
    // echo "Store unit number: " . $validated_store_unit_number . "<br>";
    // echo "Store city: " . $validated_store_city . "<br>";
    // echo "Store province: " . $validated_store_province . "<br>";

    $input_validation_checks = [$validated_store_owner_first_name, $validated_store_owner_last_name, $validated_store_business_email, $validated_store_phone_country_code, $validated_store_phone_number,
        $validated_store_name, $validated_store_type, 
        $validated_store_street_address, $validated_store_unit_number, $validated_store_city, $validated_store_province
    ];

    if(!in_array(false, $input_validation_checks)){
        // proceed
        $query = "INSERT INTO Stores (owner_first_name, owner_last_name, owner_email_address, owner_phone_number, store_name, store_type, store_street_address, store_unit_number, store_city, store_province)
            VALUES (:owner_first_name, :owner_last_name, :owner_email_address, :owner_phone_number, :store_name, :store_type, :store_street_address, :store_unit_number, :store_city, :store_province)
        ";

        $statement = $db->prepare($query);

        try{
            $db->beginTransaction();

            $statement->bindValue(":owner_first_name", $validated_store_owner_first_name);
            $statement->bindValue(":owner_last_name", $validated_store_owner_last_name);
            $statement->bindValue(":owner_email_address", $validated_store_business_email);
            $statement->bindValue(":owner_phone_number", $validated_store_phone_number);
            $statement->bindValue(":store_name", $validated_store_name);
            $statement->bindValue(":store_type", $validated_store_type);
            $statement->bindValue(":store_street_address", $validated_store_street_address);
            $statement->bindValue(":store_unit_number", $validated_store_unit_number);
            $statement->bindValue(":store_city", $validated_store_city);
            $statement->bindValue(":store_province", $validated_store_province);

            if($statement->execute()){
                $db->commit();
                header("Location: store_added.php");
                exit;
            }
        }
        catch(PDOException $e){
            if($db->inTransaction()){
                $db->rollBack();
            }
            echo "Error: " . $e->getMessage();
        }
    }
    else{
        // check which input is invalid
        $store_owner_first_name_error_message = $validated_store_owner_first_name === false ? "* Please enter a valid owner's first name." : "";
        $store_owner_last_name_error_message = $validated_store_owner_last_name === false ? "* Please enter a valid owner's last name." : "";
        $store_business_email_error_message = $validated_store_business_email === false ? "* Please enter a valid business email address." : "";
        $store_phone_country_code_error_message = $validated_store_phone_country_code === false ? "* Please enter a valid country code." : "";
        $store_phone_number_error_message = $validated_store_phone_number === false ? "* Please enter a valid phone number." : "";
        $store_name_error_message = $validated_store_name === false ? "* Please enter a valid store name." : "";
        $store_type_error_message = $validated_store_type === false ? "* Please select a valid store type." : "";
        $store_street_address_error_message = $validated_store_street_address === false ? "* Please enter a valid street address." : "";
        $store_unit_number_error_message = $validated_store_unit_number === false ? "* Please enter a valid unit number." : "";
        $store_city_error_message = $validated_store_city === false ? "* Please enter a valid city." : "";
        $store_province_error_message = $validated_store_province === false ? "* Please select a valid province." : "";

        $error_message_checks = [$store_owner_first_name_error_message,
            $store_owner_last_name_error_message,
            $store_business_email_error_message,
            $store_phone_country_code_error_message,
            $store_phone_number_error_message,
            $store_name_error_message,
            $store_type_error_message,
            $store_street_address_error_message,
            $store_unit_number_error_message,
            $store_city_error_message,
            $store_province_error_message
        ];

        $errors = [];

        foreach($error_message_checks as $check){
            if($check !== ""){
                $errors[] = $check;
            }
        }
    }

}
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
        <?php if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($errors)): ?>
        <div id="form_errors_container">
            <div id="errors">
                <?php foreach($errors as $error_message): ?>
                    <p class="error"><?= $error_message ?></p>
                <?php endforeach ?>
            </div>
        </div>
        <?php endif ?>

        <div id="add_store_main_content_container">
            <div id="add_store_form_container" class="child_box">
                <form id="add_store_form" action="#" method="post">
                    <fieldset>
                        <legend>Primary Contact Info</legend>
                        <ul>
                            <li>
                                <label for="store_owner_first_name">First Name</label>
                                <input type="text" id="store_owner_first_name" name="store_owner_first_name" class="form_input" value="<?=htmlspecialchars($store_owner_first_name)?>" placeholder="First Name">
                                <span id="store_owner_first_name_error_message" class="error_field">* Please enter a valid owner's first name.</span>
                            </li>
                            <li>
                                <label for="store_owner_last_name">Last Name</label>
                                <input type="text" id="store_owner_last_name" name="store_owner_last_name" class="form_input" value="<?=htmlspecialchars($store_owner_last_name)?>" placeholder="Last Name">
                                <span id="store_owner_last_name_error_message" class="error_field">* Please enter a valid owner's last name.</span>
                            </li>
                            <li>
                                <label for="store_business_email">Business email</label>
                                <input type="email" id="store_business_email" name="store_business_email" class="form_input" value="<?=htmlspecialchars($store_business_email)?>" placeholder="Email Address">
                                <span id="store_business_email_error_message" class="error_field">* Please enter a valid business email address.</span>
                            </li>
                            <li>
                                <label for="store_phone_number">Phone</label>
                                <div id="store_phone_number_input_container">
                                    <select id="store_phone_country_code" name="store_phone_country_code" class="select_input">
                                        <option value="+1">Can (+1)</option>
                                    </select>
                                    <input type="tel" id="store_phone_number" name="store_phone_number" class="form_input" value="<?=htmlspecialchars($store_phone_number)?>" placeholder="XXX-XXX-XXXX">
                                </div>
                                <span id="store_phone_country_code_error_message" class="error_field">* Please enter a valid country code.</span>
                                <span id="store_phone_number_error_message" class="error_field">* Please enter a valid phone number.</span>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <legend>Store details</legend>
                        <ul>
                            <li>
                                <label for="store=name">Store Name</label>
                                <input type="text" id="store_name" name="store_name" class="form_input" value="<?=htmlspecialchars($store_name)?>" placeholder="Store Name">
                                <span id="store_name_error_message" class="error_field">* Please enter a valid store name.</span>
                            </li>
                            <li>
                                <label for="store_type">Store type</label>
                                <select id="store_type" name="store_type" class="select_input">
                                    <option value="restaurant">Restaurant</option>
                                    <option value="grocery-store">Grocery Store</option>
                                    <option value="convenience-store">Convenience Store</option>
                                </select>
                                <span id="store_type_error_message" class="error_field">* Please select a valid store type.</span>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset>
                        <legend>Store Address</legend>
                        <ul>
                            <li>
                                <label for="store_street_address">Street Address</label>
                                <input type="text" id="store_street_address" name="store_street_address" class="form_input" value="<?=htmlspecialchars($store_street_address)?>">
                                <span id="store_street_address_error_message" class="error_field">* Please enter a valid street address.</span>
                            </li>
                            <li>
                                <label for="store_unit_number">Apt., Suite, Unit (Optional)</label>
                                <input type="text" id="store_unit_number" name="store_unit_number" class="form_input" value="<?=htmlspecialchars($store_unit_number)?>">
                                <span id="store_unit_number_error_message" class="error_field">* Please enter a valid unit number.</span>
                            </li>
                            <li>
                                <label for="store_city">City</label>
                                <input type="text" id="store_city" name="store_city" class="form_input" value="<?=htmlspecialchars($store_city)?>">
                                <span id="store_city_error_message" class="error_field">* Please enter a valid city.</span>
                            </li>
                            <li>
                                <label for="store_province">Province</label>
                                <select id="store_province" name="store_province" class="select_input" value="><?=htmlspecialchars($store_province)?>">
                                    <option value="manitoba">Manitoba</option>
                                </select>
                                <span id="store_province_error_message" class="error_field">* Please select a valid province.</span>
                            </li>
                        </ul>
                    </fieldset>
                    <button type="submit" id="submit" class="black_button">Submit</button>
                </form>
            </div>
            <div id="add_restaurant_page_side_image_container" class="child_box">
            <img id="add_restaurant_page_side_image" src="images/add_restaurant_page_side_image.jpeg" alt="add restaurant">
            </div>
        </div>
    </main>
    <script src="add_store.js"></script>
</body>
</html>

<?php

require 'footer.php';

?>