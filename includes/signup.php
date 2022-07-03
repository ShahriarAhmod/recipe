<?php
if (!isset($_SESSION)) {
    session_start();
}
// Signup 
if (isset($_POST["SignUp"])) {

    $First_Name = $_POST["FirstName"];
    $Last_Name = $_POST["LastName"];
    $Email = $_POST["Email"];
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];
    $Confirmed_Password = $_POST["ConfirmPassword"];


    if (User::Email_Exists($Email)) {
        $msg = "This email already exists ! Try again...";
        Message::Show($msg, Message::$danger, 75, "modal-signup");
    }

    if (User::Username_Exists($Username)) {
        $msg = "This username already exists ! Try again...";
        Message::Show($msg, Message::$danger, 75, "modal-signup");
    }

    if ($Password != $Confirmed_Password) {
        $msg = "The password and its confirmation are not the same ! Try again...";
        Message::Show($msg, Message::$danger, 75, "modal-signup");
    }
    if (
        empty($First_Name) || empty($Last_Name) || empty($Email) ||
        empty($Username) || empty($Password) || empty($Confirmed_Password)
    ) {
        $msg = "Enter a value for each required field !";
        Message::Show($msg, Message::$danger, 75);
    } else {
        if (!User::Email_Exists($Email) && !User::Username_Exists($Username) && $Password == $Confirmed_Password) {
            $userObj = new User($First_Name, $Last_Name, $Email, $Username, $Password, 2);
            $userObj->Insert();
            Message::Show("Your account is successfully created !", 2);

            $_SESSION["Username"] = $Username;
            $_SESSION["User_ID"] = User::GetField($Username, 'user_id');
            $_SESSION["Role_ID"] = 2;
            // $_SESSION["Role_ID"] = User::GetField($Username, 'role_id');
            header('Location: ./member/index.php');
        }
    }
}
