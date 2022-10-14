<?php
require '../csv_util.php';

$utilities = new Utilities();

//if we have the index of author and the quote string from the detail form
if (isset($_POST['author_index']) && isset($_POST['quote'])) {
    $authors = $utilities->getArrayFromCsv('../authors.csv');
    displayModifyQuote($_POST['quote'], $_POST['author_index'], $_POST['quote_index'], $authors);
}
//if the quote has been modified
else if (isset($_POST['record'])) {

    if ($utilities->modifyRecord('../quotes.csv', $_POST['authorIndex'], $_POST['quoteIndex'], $_POST['record']) == true) {
        $j = $_POST['quoteIndex'];
        $i = $_POST['authorIndex'];
        ?>
        <div>
            <p><?php 'The quote has been modified'?></p>
            <a href="detail.php?index=<?=$i?>&quote=<?=$j?>&quoteModified=<?=true?>"><?= 'Detail' ?></a>
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
 function displayModifyQuote($quote, $authorIndex, $quoteIndex, $authors) {
     ?>
     <!doctype html>
     <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         <title><?= 'Modify Quote' ?></title>
     </head>
     <body>
     <div class="container text-center">
         <form action="modify.php" method="post">
             <div class="form-group">
                 <div class="form-outline mb-4">
                         <?php
                             ?>
                             <h3><?= '"' . $quote . '"' ?></h3>
                             <h6><?= $authors[$authorIndex][0] . ' ' . $authors[$authorIndex][1];?></h6>
                             <?php
                         ?>
                 </div>
             </div>
             <div class="form-group">
                 <div class="form-outline mb-4">
                     <label for="record"><?='Edit the quote'?></label>
                     <input type="text" value="<?=$quote?>" name="<?= 'record' ?>" />
                     <input type="hidden" value="<?= $quoteIndex ?>" name="<?= 'quoteIndex' ?>" />
                     <input type="hidden" value="<?= $authorIndex ?>" name="<?= 'authorIndex' ?>" />
                     <button class="btn btn-primary" type="submit"><?='Submit quote modification'?></button>
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
