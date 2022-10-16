<?php
session_start();
require "../csv_util.php";
require "../auth/auth.php";

$utitlies = new Utilities();
if (is_logged()) {

?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
        <link rel="stylesheet" href="assets/css/detail.css" />
        <title><?= "Quote Detail"; ?></title>
    </head>
    <body>
    <?php
    $i = $_GET['index'];
    $j = $_GET['quote'];
    //get the author and quote
    $quotes = $utitlies->getArrayElementFromCsv('../quotes.csv', $_GET['index']);
    $author = $utitlies->getArrayElementFromCsv('../authors.csv', $_GET['index']);

        ?>
    <div class="container text-center mb-5">
        <form method="post" action="delete.php">
            <h3><?= '"'. $quotes[$_GET['quote']] . '"' ?></h3>
            <h6><?php echo ' -' . $author[0]  . ' ' . $author[1] ?></h6>
            <div class="form-group">
                <div class="form-outline mb-4">
                    <input type="hidden" name="<?='author_index'?>" value="<?=$i?>" />
                    <input type="hidden" name="<?='quote_index'?>" value="<?=$j?>"/>
                    <input type="hidden" name="<?='quote'?>" value="<?=$quotes[$j]?>" />
                    <input type = "submit" name = "submit" value = "<?= 'Delete Quote'?>">
                </div>
            </div>
        </form>
        <form method="post" action="modify.php">
            <div class="form-group">
                <div class="form-outline mb-4">
                    <input type="hidden" name="<?='author_index'?>" value="<?=$i?>" />
                    <input type="hidden" name="<?='quote_index'?>" value="<?=$j?>"/>
                    <input type="hidden" name="<?='quote'?>" value="<?=$quotes[$j]?>" />
                    <input type = "submit" value = "<?='Modify Quote'?>" name = "<?= 'submitModifyQuote' ?>">
                </div>
                <div class="form-outline mb-4">
                    <a href="<?='../index.php'?>"><?='Back to index'?></a>
                </div>
            </div>
        </form>
    </div>
        <?php
    }
    else {
        header('Location: ../index.php');
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>

