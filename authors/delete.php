<?php
session_start();
require "../csv_util.php";
require "../auth/auth.php";
require "author.php";


if (isset($_POST['author_index']) && is_logged()) {

    $utilities = new Utilities();
    $_SESSION['authorIndex']  = $_POST['author_index'];
    requestDeleteAuthor($utilities->getArrayElementFromCsv('../authors.csv', $_POST['author_index']));
}
//if the user submitted the delete confirmation
else if (isset($_POST['delete_confirm'])) {
    $utilities = new Utilities();
    if($_POST['delete_confirm'] == 'Yes') {
        //delete author using utility function
        $i = $_SESSION['authorIndex'];

        if ($utilities->deleteRowFromCsv('../authors.csv', $i) == true
            && $utilities->deleteRowFromCsv('../quotes.csv', $i) == true) {
            displayDeletedConfirmation($i);
        }
    }
    else if ($_POST['delete_confirm'] == 'No') {
        header('Location: ../index.php?deleteAuthorDeclined=true');
    }
}
else {
    header('Location: ../index.php');
}


//request confirmation and delete the author
function requestDeleteAuthor($author)
{
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
<div class="container text-center mb-5">
    <form method="post" action="delete.php">
        <p><?php echo 'Do you want to remove ' . $author[0] . ' ' . $author[1] . ' ?' ?></p>
        <div class="form-group">
            <div class="form-outline mb-4">
                <strong><input type="radio" value="<?='Yes'?>" name="<?='delete_confirm'?>"/><?='Yes'?></strong><br>
                <strong><input type="radio" value="<?='No'?>" name="<?='delete_confirm'?>"/><?='No'?></strong><br>
                <input type = "submit" name = "submit" value = "<?= 'Delete Author'?>">
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php
}

function displayDeletedConfirmation($i) {
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
<body>
<div class="container text-center mb-5">
    <div class="container text-center">
        <p><?php 'The author has been deleted'?></p>
        <a href="../index.php">
            <input type="<?='submit'?>" value="<?='Back to index'?>"/>
        </a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php
}
?>
