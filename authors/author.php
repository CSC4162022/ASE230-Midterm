<?php


class Author {

    public $fileName;
    public $authorList;
    public $authorFirst;
    public $authorLast;

    function __construct($fileName) {
        $utilities = new Utilities();
        $this->fileName = $fileName;
        $this->authorList = $utilities->getArrayFromCsv($fileName);
    }

    function setAuthorName($authorFirst, $authorLast) {
        $this->authorFirst = $authorFirst;
        $this->authorLast = $authorLast;
    }

    function setAuthors($authorList)  {
        $this->$authorList = $authorList;
    }

    function getAuthors() {
        return $this->authorList;
    }

    function addAuthorToCsv($fileName, $authorsList, $authorFirst, $authorLast) {

        try {
            // Fill the CSV file.
            $file = fopen($fileName, 'w');
            foreach ($authorsList as $fields) {
                fputcsv($file, $fields);
            }
            fclose($file);

            // Add a new line at the end of the file
            $file = fopen($fileName, 'a');
            fputcsv($file, [$authorFirst, $authorLast]);
            fclose($file);
            return true;
        } catch (Exception $ex) {
            die('failed to add author');
        }

    }
}