<?php
require '../csv_util.php';



//if we have the index of author and the quote string from the detail form
if (isset($_POST['author_index'])) {
    $utilities = new Utilities();
    $authors = $utilities->getArrayFromCsv('../authors.csv');
    displayModifyAuthor($_POST['author_index'], $authors);
}
//if the author has been modified
else if (isset($_POST['authorFirstName'])
    && isset($_POST['authorLastName'])
    && isset($_POST['authorIndex'])) {
    $utilities = new Utilities();
    if ($utilities->modifyRecord('../authors.csv', $_POST['authorIndex'], 0, $_POST['authorFirstName']) == true
        && $utilities->modifyRecord('../authors.csv', $_POST['authorIndex'], 1, $_POST['authorLastName']) == true) {
        $i = $_POST['authorIndex'];
        ?>
        <div>
            <p><?php 'The author has been modified'?></p>
            <a href="detail.php?index=<?=$i?>&authorModified=<?=true?>"><?= 'Detail' ?></a>
        </div>
        <?php
        header('Location: ../index.php');
    }
    else {
        header('Location: ../modify.php');
    }
}
?>
<?php
function displayModifyAuthor($authorIndex, $authors) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title><?= 'Modify Author' ?></title>
    </head>
    <body>

    <div class="container text-center">
        <form action="modify.php" method="post">
            <p><?='Modify the author by entering a new first or last name'?></p>
            <div class="form-group">
                <h3><?= $authors[$authorIndex][0] . ' ' . $authors[$authorIndex][1] ?></h3>
                <div class="form-outline mb-4">
                    <label for="authorFirstname"><?='First name'?></label>
                    <input type="text" value="<?= $authors[$authorIndex][0] ?>" name="<?= 'authorFirstName' ?>" />
                </div>
                <div class="form-outline mb-4">
                    <label for="authorFirstname"><?='Last name'?></label>
                    <input type="text" value="<?= $authors[$authorIndex][1] ?>" name="<?= 'authorLastName' ?>" />
                </div>
                <div class="form-outline mb-4">
                    <input type="hidden" value="<?= $authorIndex ?>" name="<?= 'authorIndex' ?>" />
                    <button class="btn btn-primary" type="submit"><?='Submit author name modification'?></button>
                </div>
                <div class="form-outline mb-4">
                    <a href="<?='../index.php'?>"><?='Back to index'?></a>
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
