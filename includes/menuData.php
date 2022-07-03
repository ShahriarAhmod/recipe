<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/recipe/classes/meal.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/recipe/classes/category.php";

$menu_left_data = array(

    "brand" => array(
        "name" => "Recipe",
        "link" => "index.php"
    ),
    "nav-class" => "mr-auto",
    "menu" => array(
        array(
            "name" => "Home",
            "link" => "index.php"
        ),
        array(
            "name" => "Meal Type",
            "link" => Meal::MealMenu()
        ),
        array(
            "name" => "Categories",
            "link" => Category::CategoryMenu()
        )
    )
);


if (isset($_SESSION["Username"])) {
    $menu_right_data = array(
        "nav-class" => "ml-auto",
        "menu" => array(
            array(
                "name" => $_SESSION["Username"],
                "link" => array(
                    array(
                        "name" => "Favorite",
                        "link" => "favorite.php",
                        "realPage" => ""
                    ),
                    array(
                        "name" => "Logout",
                        "link" => "logout.php",
                        "realPage" => ""
                    )
                ),
            )
        )
    );
} else {
    $menu_right_data = array(
        "nav-class" => "ml-auto",
        "menu" => array(
            array(
                "name" => "Login",
                "link" => "#",
                "data-target" => "modal-login"
            ),
            array(
                "name" => "SignUp",
                "link" => "#",
                "data-target" => "modal-signup"
            )
        )
    );
}
