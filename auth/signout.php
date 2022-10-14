<?php
require '../auth/auth.php';
session_start();
// if the user is not logged in, redirect them to the public page

signout();