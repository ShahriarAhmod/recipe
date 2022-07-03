<?php
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST["Login"])) {
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    // echo $Username.'</br>';
    // echo $Password.'</br>';

    // echo "Answer = ".User::Login($Username, $Password);
    if (User::Login($Username, $Password)) {
        // Message::Show("Your are successfully logged-in !", Message::$Full_Size, Message::$Success);
        $_SESSION["Username"] = $Username;
        $_SESSION["User_ID"] = User::GetField($Username, 'user_id');
        $_SESSION["Role_ID"] = User::GetField($Username, 'role_id');

        // echo 'User role is ' . $_SESSION["Username"];

        if ($_SESSION["Role_ID"] == 1) {
            header('Location: ./admin/index.php');
        } else if ($_SESSION["Role_ID"] == 2) {
            header('Location: ./member/index.php');
        } else {
            Message::Show("Login but not redirecting to any page.");
        }
        // Message::Show("Login Successful.", 2, 75);
    } else {
        Message::Show("Your Username and Password do not match with our records !", 3, 75, "modal-login");
    }
}

?>
