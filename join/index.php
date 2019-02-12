
<?php

require('../resorces/configuration.php');
require('../resorces/functions/general_functions.php');
require('../resorces/functions/page_functions.php');
session_start();

$error = [];

if (!empty($_POST)) {
    // Validation
    //print_r($_POST);
    if ($_POST['name'] == '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] == '') {
        $error['email'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] == '') {
        $error['password'] = 'blank';
    }

    if (!empty($_FILES['image']['name'])) {
        $ext = substr($_FILES['image']['name'], -3);
        if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
            $error['image'] = 'type'; 
        }
        echo $ext;
    }

    print_r($_FILES);


    if (empty($error)) {
        // Upload a image file
        $imageName = date('YmdHis') . '_' . $_FILES['image']['name'];
        echo $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], '../member_pictures/' . $imageName);
        $_SESSION['join'] = $_POST;
        $_SESSION['join']['image'] = $imageName;
        echo 'no errors';
        header('Location: check.php');
        //echo 'success';
    }

    

    // echo 'email';
    // var_dump($_POST['email']);
    // var_dump((!empty($_POST['email'])));
    
    // var_dump(empty($error));
    // echo '<br><br>';
    // echo 'error: ';
    // print_r($error);
    // echo '<br><br>';
    // echo 'post: ';
    // print_r($_POST);
    // echo '<br><br>';
    if (!isset($_SESSION['join'])):
        echo 'session join : ';
        print_r($_SESSION['join']);
    endif;
}

if ($_REQUEST['action'] == 'rewrite') {
    $_POST = $_SESSION['join'];
    print_r($_POST);
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registration</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Registration</h1>

            <div class="lead-message">
                <p>Please input your information</p>
            </div>
            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                <dl class="dl-list-01">
                    <dt>User Name<span class="required">Required</span></dt>
                    <dd>
                        <input type="text" name="name" size="35" maxlength="50" value="<?php if (!empty($_POST['name'])): echo hsc($_POST['name']); endif;?>">
                        <?php if (!isset($error['name'])): ?>
                        <?php elseif($error['name'] == 'blank'): ?>
                            <p class="error-message">Please enter your name</p>
                        <?php endif;?>

                    </dd>
                    <dt>Email<span class="required">Required</span></dt>
                    <dd>
                        <input type="text" name="email" size="35" maxlength="100" value="<?php if (!empty($_POST['email'])): echo hsc($_POST['email']); endif;?>">
                        <?php if (!isset($error['email'])): ?>
                        <?php elseif($error['email'] == 'blank'): ?>
                            <p class="error-message">Please enter your email</p>
                        <?php endif;?>
                    </dd>
                    <dt>Password<span class="required">Required</span></dt>
                    <dd>
                        <input type="password" name="password" size="35" maxlength="50" value="<?php if (!empty($_POST['password'])): echo hsc($_POST['password']); endif;?>">
                        <?php if (!isset($error['password'])): ?>
                        <?php elseif($error['password'] == 'blank'): ?>
                            <p class="error-message">Please enter your password</p>
                        <?php elseif($error['password'] == 'length'): ?>
                            <p class="error-message">Your password should be more than 4 characters</p>
                        <?php endif;?>
                    </dd>
                    <dt>Image</dt>
                    <dd>
                        <input type="file" name="image" size="35">
                        <?php if (!isset($error['image'])): ?>
                        <?php elseif ($error['image'] == 'type'):
                        ?>
                        <p class="error-message">The system cannot accept the file you uploaded.<br>Only accept jpg, gif, png.</p>
                        <?php endif; ?>
                    </dd>
                </dl>
                <input type="submit" value="View">
            </form>
        </div>
    </body>
</html>
