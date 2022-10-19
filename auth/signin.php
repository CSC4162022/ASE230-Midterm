<?php
session_start();
require '../csv_util.php';
require '../auth/auth.php';
// if the user is alreay signed in, redirect them to the members_page.php page

if(count($_POST)>0){
    // 1. check if email and password have been submitted
    if(isset($_POST['email']) && isset($_POST['password'])) {
        // 2. check if the email is well formatted
        // 3. check if the password is well formatted
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (signin($email, $password, '../data/users.csv', '../data/banned.csv')) {
            header('Location: ../index.php');
        }
    }
    else if (is_logged()) {
        header('Location: ../index.php');
    }
    else $_SESSION['logged']=false;
    header('Location: ../index.php?failedSignin=true');
}



?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
        <link rel="stylesheet" href="assets/css/detail.css" />
        <title><?= "Sign in"; ?></title>
    </head>
    <body>
    <div class="container text-center"
    <div class="container text-center">
        <form method="POST" action="../auth/signin.php">
            <h6><?='Sign In'?></h6>
            <label for="email"><?='Email'?></label>
            <input type="email" name="email" />
            <label for="email"><?='Password'?></label>
            <input type="password" name="password" />
            <input type="submit" value="submit" />
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>