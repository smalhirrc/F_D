<?php

require 'header.php';

 $message = "Thank you! Your store has been successfully added to our platform.";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <div id="store_added_main_content_container">
            <?php if(isset($message)): ?>
            <div id="store_add_success_message_container">
                <p><?= $message ?></p>
            </div>
            <?php endif ?>
            
            <div id="view_added_store_container">
                <h1>Store Name, Store type</h1>
                <ul>
                    <li><a href="#">Manage Store</a></li>
                </ul>
            </div>
        </div>
    </main>
</body>
</html>

<?php

require 'footer.php';

?>