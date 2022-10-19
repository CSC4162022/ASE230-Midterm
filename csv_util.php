<?php

class Utilities {


    //append record to end of row or create new row
    function addRecord($fileName, $authorIndex, $quote, $addNewAuthor) {

        $utilities = new Utilities();
        $quotes = $utilities->getArrayFromCsv('../quotes.csv');
        if ($addNewAuthor || $authorIndex > count($quotes)) {
            // Fill the CSV file.
            $file = fopen($fileName, 'w');
            foreach ($quotes as $fields) {
                fputcsv($file, $fields);
            }
            fclose($file);

            // Add a new line at the end of the file
            $file = fopen($fileName, 'a');
            fputcsv($file, [$quote]);
            fclose($file);
            return true;

        }
        else  {
            $input = fopen($fileName, 'r');  //open for reading
            $output = fopen('../temporary.csv', 'w'); //open for writing
            $i = 0;
            //get row contents using index of the author
            while( false !== ( $data = fgetcsv($input) ) ){  //read line as array

                //stop at selected author
                if ($i == $authorIndex) {
                    array_push($data, $quote);
                    fputcsv($output, $data);
                    $i++;
                    continue;
                }
                $i++;
                //write modified data to new file
                fputcsv( $output, $data);
            }

            fclose( $input );
            fclose( $output );

            //clean up
            unlink($fileName);// Delete
            rename('../temporary.csv', $fileName); //Rename
            return true;
        }
    }

    function modifyRecord($fileName, $authorIndex, $recordIndex, $record) {
        //get array of csv contents
        $utilities = new Utilities();
        $csvArray = $utilities->getArrayFromCsv($fileName);
        $size = count($csvArray);
        $i = 0;
        $input = fopen($fileName, 'r');  //open for reading
        $output = fopen('../temporary.csv', 'w'); //open for writing

        //get row contents using index of the author
        while( false !== ( $data = fgetcsv($input) ) ){  //read line as array
            //stop at selected author
            if ($i == $authorIndex) {
                for ($j=0;$j<count($data);$j++) {
                    if ($j == $recordIndex) {
                        //$elem[] = $record;
                        $data[$j] = $record;
                        fputcsv($output, $data);
                    }
                }
                $i++;
                continue;
            }
            $i++;
            //write modified data to new file
            fputcsv( $output, $data);
        }
        fclose( $input );
        fclose( $output );
        //clean up
        unlink($fileName);// Delete
        rename('../temporary.csv', $fileName); //Rename
        return true;
    }



    //Per instructions, a function to remove the contents of the entire row
    function deleteRowFromCsv($fileName, $authorIndex) {

        try {
            $i = 0;
            $input = fopen($fileName, 'r');  //open for reading
            $output = fopen('../temporary.csv', 'w'); //open for writing

            //get row contents using index of the author
            while( false !== ( $data = fgetcsv($input) ) ){  //read line as array
                //stop at selected author
                if ($i == $authorIndex)
                {
                    $i++;
                    continue;
                    //skip the row
                }
                else {
                    $i++;
                    fputcsv($output, $data);
                }
            }
            fclose( $input );
            fclose( $output );
            //clean up
            unlink($fileName);// Delete
            rename('../temporary.csv', $fileName); //Rename
            return true;
        } catch (Exception $ex) {
            die($ex . ' ' . ' deleting row from ' . $fileName);
        }
    }


    //validate the email and password
    function validateSigninInput($email, $password) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        //password doesn't contain at least 2 symbols or isn't long enough
        else if (!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $password) || strlen($password) < 8)
        {
            return false;
        }
        return true;
    }

    function userIsBanned($email)
    {
        $bannedUsersLine = fopen('../data/banned.csv', 'r');
        while (false !== ($data = fgetcsv($bannedUsersLine))) {
            if ($data[0] == $email) {
                return true;
            }
        }
        return false;
    }

    //check if the file containing banned users exists, check if the email has been banned
    //check if the file containing users exists, check if the email is registered
    function verifyUser($usersFile, $bannedUsersFile, $email) {
        $utilities = new Utilities();
        $emailMatch = false;
        if(file_exists($usersFile) && file_exists($bannedUsersFile)) {

            $usersLine = fopen($usersFile, 'r');  //open for reading
            while( false !== ( $data = fgetcsv($usersLine) ) ) {
                if($data[0] == $email) {
                    $emailMatch = true;
                }
            }
            if ($utilities->userIsBanned($email) == true) {
                die('You are banned');
            }
            if ($emailMatch == true) {
                return true;
            }
        }
        else {
            return false;
        }

    }

    function verifyPassword($password, $email, $usersFile) {

        $usersLine = fopen($usersFile, 'r');  //open for reading
        while( false !== ( $data = fgetcsv($usersLine) ) ) {
            if($data[0] == $email) {
                $verify = password_verify($password, $data[1]);
                if ($verify) {
                    return true;
                }
            }
        }
        return false;
    }

    //delete the single string
    function deleteStringFromCsv($quote, $quoteIndex, $authorIndex, $fileName) {

        //get array of csv contents
        $csvArray = $this->getArrayFromCsv($fileName);
        $i = 0;
        $input = fopen($fileName, 'r');  //open for reading
        $output = fopen('../temporary.csv', 'w'); //open for writing

        //get row contents using index of the author
        while( false !== ( $data = fgetcsv($input) ) ){  //read line as array
            //stop at selected author
            if ($i == $authorIndex) {
                $temp = $data;
                for ($j=0;$j<count($data);$j++) {
                    if ($j == $quoteIndex) {
                        unset($temp[$quoteIndex]);
                        fputcsv($output, $temp);
                    }
                }
                $i++;
                continue;
            }
            $i++;
            //write modified data to new file
            fputcsv( $output, $data);
        }
        fclose( $input );
        fclose( $output );
        //clean up
        unlink($fileName);// Delete
        rename('../temporary.csv', $fileName); //Rename
        return true;
    }

    //read the content of the csv file and return an array
    function getArrayFromCsv($fileName) {
        return $arr = array_map('str_getcsv', file($fileName));

    }

    function getArrayElementFromCsv($fileName, $index) {
        $arr = array_map('str_getcsv', file($fileName));
        return $arr[$index];
    }

    function emailExists($email, $usersFile) {

        $usersLine = fopen($usersFile, 'r');  //open for reading
        while( false !== ( $data = fgetcsv($usersLine) ) ) {
            if($data[0] == $email) {
                return true;
            }
        }
        return false;
    }


    function encryptPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}

?>