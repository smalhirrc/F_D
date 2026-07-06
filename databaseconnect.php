<?php
define("DATABASE", "mysql:host=localhost;dbname=FoodDeliveryApp;charset=utf8");
define("USER_NAME", "sukhpreet");
define("PASSWORD", "password");

try {
    $db = new PDO(DATABASE, USER_NAME, PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database connection successful";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>