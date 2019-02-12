<?php
require('../resorces/configuration.php');
require('../resorces/functions/general_functions.php');
require('../resorces/functions/page_functions.php');

session_start();


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Completed | Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Completed</h1>

            <div class="lead-message">
                <p>Your account has been successfully created.</p>
            </div>
            <p><a href="../">Login</a></p>
        </div>
    </body>
</html>