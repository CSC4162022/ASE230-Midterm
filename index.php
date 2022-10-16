<?php
session_start();
require "./csv_util.php";
require "./auth/auth.php";

$utilities = new Utilities();

function printAuthorsQuotes($authors, $quotes) {

    try {
        for($i=0; $i<count($authors); $i++){
            if ($authors[$i][0] && $authors[$i][1]) {
                ?>
                <p><strong><?= $authors[$i][0] ?> <?= $authors[$i][1] ?></strong><a href="authors/detail.php?index=<?=$i?>"><?= ' Detail' ?></a></p>
                <?php
            }
            for($j=0; $j<count($quotes[$i]); $j++) {
                if ($quotes[$i][$j]) {
                    ?>
                    <p><?= $quotes[$i][$j] ?><a href="quotes/detail.php?index=<?=$i?>&quote=<?=$j?>"><?= 'Quote Detail' ?></a></p>
                    <?php
                }
            }
        }
    } catch (Exception $ex) {
        die('Exception: ' . $ex);
    }

}

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/index.css" />
        <title><?= 'Midterm' ?></title>
    </head>
    <body>
    <form class="">
        <div class="container text-center">
            <div class="form-outline mb-4">
            <?php
            printAuthorsQuotes($utilities->getArrayFromCsv('./authors.csv'),$utilities->getArrayFromCsv('./quotes.csv'));
            if (is_logged() == true) {
                ?>
                <p><?= $_SESSION['email'] . ' is logged in' ?></p>
                <p><a href="quotes/create.php?"><?= 'Create Quote' ?></a></p>
                <p><a href="authors/create.php?"><?= 'Create Author' ?></a></p>
                <p><a href="auth/signout.php?"><?= 'Sign Out' ?></a></p>
                <?php
            }
            else {
                if (isset($_SESSION['newEnrolledUser'])) {
                    ?>
                    <h6><?= 'Welcome new user, please sign in.' ?></h6>
                    <?php
                }
                if (isset($_GET['deleteQuoteDeclined']) || isset($_GET['deleteAuthorDeclined'])) {
                    ?>
                    <h6><?= 'Operation declined.' ?></h6>
                    <?php
                }
                ?>
                <p><strong><?='Please sign in to view author and quote details'?></strong></p>
                <p><a href="auth/signin.php?"><?= 'Sign In' ?></a></p>
                <p><a href="auth/signup.php?"><?= 'Sign Up' ?></a></p>
                <?php
            }
            ?>
            </div>
        </div>
    </form>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>


