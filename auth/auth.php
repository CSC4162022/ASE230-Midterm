<?php

// add parameters
function signup($email, $password, $usersFile)
{
    $utilities = new Utilities();
    // add the body of the function based on the guidelines of signup.php
    if (!$utilities->validateSigninInput($email, $password)) {
        return false;
    }
    if ($utilities->userIsBanned($email)) {
        return false;
    }
    // check if the email is in the database already
    if ($utilities->emailExists($email, $usersFile)) {

        header('Location: signup.php');
    } else {
        // encrypt password
        // save the user in the database
        saveNewUser('../data/users.csv', $email, $utilities->encryptPassword($password));
        $_SESSION['newEnrolledUser'] = true;
        return true;
    }
    return false;
}

function saveNewUser($usersFile, $email, $passwordHash) {
    $file = new SplFileObject($usersFile, 'a');
    $file->fputcsv(array($email, $passwordHash));
    $file = null;
}


function signin($email, $password, $usersFile, $bannedUsersFile){

    $utilities = new Utilities();
    if ($utilities->validateSigninInput($email, $password)) {
        if($utilities->verifyUser($usersFile, $bannedUsersFile, $email)) {
            if ($utilities->verifyPassword($password, $email, '../data/users.csv')) {
                // 9. store session information
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['logged']=true;
                // 10. redirect the user to the index.php page
                return true;
            }
        }
    }
	return false;
}

function signout(){
	// add the body of the function based on the guidelines of signout.php
    $_SESSION['logged']=false;
    session_destroy();
    header('Location: ../index.php');
}

function is_logged(){
    if (isset($_SESSION['logged']) && $_SESSION['logged']==true) {
       return true;
    }
	return false;
}