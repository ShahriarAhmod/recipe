<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION)) {
    unset($_SESSION["Username"]);
    unset($_SESSION["User_ID"]);
    unset($_SESSION["Role_ID"]);
    header('Location: ../index.php');  // Go back to public index page 
}else{
    header('Location: ./index.php');     // Go back to admin index page    
}
