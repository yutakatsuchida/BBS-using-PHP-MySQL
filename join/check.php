<?php

require('../resorces/configuration.php');
require('../resorces/functions/general_functions.php');
require('../resorces/functions/page_functions.php');

session_start();
require('../dbconnect.php');

if (!empty($_SESSION['join'])):


    $memberName = $_SESSION["join"]["name"];
    $memberEmail = $_SESSION["join"]["email"];
    $memberPassword = password_hash ($_SESSION["join"]["password"], PASSWORD_DEFAULT);
    $memberPicture = $_SESSION["join"]["image"];
    $memberDate = date('Y-m-d H:i:s');
    //echo "<h1>${memberName}<br>${memberEmail}<br>${memberPassword}<br>${memberPicture}</h1>";

    // $sql = "INSERT INTO `members` (`name`, `email`, `password`, `picture`, `created`)
    // VALUES ('$memberName', '$memberEmail', '$memberPassword', '$memberPicture', '$memberDate')";

    
    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
    
    // $conn->close();

    // SQL文を準備します。「:id」「:name」がプレースホルダーです。
    $sql = 'INSERT INTO `members` (`name`, `email`, `password`, `picture`, `created`) VALUEs (:name, :email, :password, :picture, :created)';

    $prepare = $dbh->prepare($sql);

    $prepare->bindValue(':name', $memberName, PDO::PARAM_STR);
    $prepare->bindValue(':email', $memberEmail, PDO::PARAM_STR);
    $prepare->bindValue(':password', $memberPassword, PDO::PARAM_STR);
    $prepare->bindValue(':picture', $memberPicture, PDO::PARAM_STR);
    $prepare->bindValue(':created', $memberDate, PDO::PARAM_STR);
    $prepare->execute();

    // INSERTされたデータを確認します
    $sql = 'SELECT * FROM ' . DB_NAME;
    $prepare = $dbh->prepare($sql);

    $prepare->execute();

    $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
    var_dump($result);

    header('Location: complete.php');
endif;

// If there is no any information in session, go to index.php
if (!isset($_SESSION['join'])) {
    header('Location: index.php');
}
print_r($_SESSION['join']);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Confirmation | Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Confirmation</h1>

            <form action="" method="post">
                <input type="hidden" name="action" value="submit">
                <dl class="dl-list-01">
                    <dt>User Name</dt>
                    <dd>
                        <?php echo hsc($_SESSION['join']['name']); ?>
                    </dd>
                    <dt>Email</dt>
                    <dd>
                        <?php echo hsc($_SESSION['join']['email']); ?>
                    </dd>
                    <dt>Password</dt>
                    <dd>
                        <?php echo hsc(str_repeat("*", mb_strlen($_SESSION['join']['password'], "UTF8"))); ?>
                    </dd>
                    <dt>Image</dt>
                    <dd>
                        <?php
                            echo "<img src='../" . DIR_MEMBER_PICTURES . "/" . ($_SESSION['join']['image']) . "' width='100'>";
                        ?>
                    </dd>
                </dl>
                <a href="index.php?action=rewrite">Rewrite</a> | 
                <input type="submit" value="Confirm">
            </form>
        </div>
    </body>
</html>