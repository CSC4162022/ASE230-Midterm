<?php
require '../csv_util.php';
require '../auth/auth.php';
require 'author.php';

session_start();

if (!is_logged()) {
    header('Location: ../index.php');
}

$utilities = new Utilities();
$author = new Author('../authors.csv');
$authors = $author->getAuthors();
$newAuthorIndex = count($authors) + 1;

if (isset($_POST['authorFirstName'])  && isset($_POST['authorLastName']) && isset($_POST['quote'])) {
    $author = new Author('../authors.csv');
    print_r($_POST);
    if ($author->addAuthorToCsv('../authors.csv', $author->getAuthors(), $_POST['authorFirstName'],  $_POST['authorLastName'])) {
        $utilities->addRecord('../quotes.csv', $newAuthorIndex,  $_POST['quote'], true);
        header('Location: ../index.php');
    }
    else  {
        header('Location: create.php');
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?= 'Add Author' ?></title>
</head>
<body>
<div class="container text-center">
    <form action="create.php" method="post">
        <h5><?='Author Creation'?></h5>
        <p><?='Add a new author'?></p>
        <div class="form-group">
            <div class="form-outline mb-4">
                <label for="authorFirstname"><?='Author first name'?></label>
                <input type="text" name="<?='authorFirstName'?>">
            </div>
            <div class="form-outline mb-4">
                <label for="authorFirstname"><?='Author last name'?></label>
                <input type="text" name="<?='authorLastName'?>">
            </div>
        </div>
        <div class="form-group">
            <div class="form-outline mb-4">
                <label for="quote"><?='quote'?></label>
                <input type="text" name="<?='quote'?>">
                <button class="btn btn-primary" type="submit"><?='Submit new author'?></button>
            </div>
        </div>
</div>
</form>
<div class="row">
    <a href="<?='../index.php'?>"><?='Back to index'?></a>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>