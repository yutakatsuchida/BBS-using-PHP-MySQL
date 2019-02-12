<?php

//require('resorces/configuration.php');

try {
    $dbh = new PDO(DB_DSN, DB_ACCOUNT_NAME, DB_ACCOUNT_PASS);
    //echo "Succeeded\n";
} catch (PDOException $e) {
    echo "Detabase connection Error: " . $e->getMessage() . "\n";
    exit();
}


?>