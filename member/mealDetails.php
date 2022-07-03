<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/recipe/classes/recipe.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/recipe/classes/meal.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/recipe/classes/category.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/recipe/classes/Message.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/recipe/classes/rating.php";

// $_SESSION["Username"];
// $_SESSION["User_ID"] ;
// $_SESSION["Role_ID"];


if (!isset($_SESSION)) {
    session_start();
}

if (isset($_POST['menuDropDown'])) {

    if ($_POST["mainMenuName"] == "Meal Type") {
        // Main Meal DropDown Click
        //! check DisplayRecipeCards definition before calling.
        $array = Recipe::ReadRecipe($_POST["menuItemName"]);
        $str = Recipe::DisplayRecipeCard($array, true);

        if (empty($str)) {
            $str = '<div class="alert alert-warning" role="alert">
            No Data Found
          </div>';
        }
        echo json_encode($str);
    } else if ($_POST["mainMenuName"] == "Categories") {
        // Category DropDown Click
        //! check DisplayRecipeCard definition before calling.
        $array = Recipe::ReadRecipe(0, $_POST["menuItemName"]);
        $str =  Recipe::DisplayRecipeCard($array, true);

        if (empty($str)) {
            $str = '<div class="alert alert-warning" role="alert">
            No Data Found
          </div>';
        }
        echo json_encode($str);
    }
}


if (isset($_POST['fullRecipeDetail'])) {
    $str = Recipe::DisplayRecipeFullInfo($_POST['cardId']);
    echo $str;
    // echo json_encode($str);
}


if (isset($_POST['simpleSearch'])) {
    if (!empty($_POST['queryData'])) {
        $array = Recipe::SearchQuery($_POST['queryData']);
    } else {
        $array = Recipe::ReadRecipe();
    }

    $str = Recipe::DisplayRecipeCard($array, true);

    if (empty($str)) {
        $str = '<div class="alert alert-warning mt-5" role="alert">
        No Data Found
      </div>';
    }

    echo json_encode($str);
}


if (isset($_POST['ratingClick'])) {
    if (!isset($_SESSION['Username'])) {
        $msg = 'Please Login to rate a recipe.';;
        Message::Show($msg, 3, 75, "modal-login");
    } else {
        $objRating = new Rating($_POST['recipeID'], $_SESSION["User_ID"], $_POST['index']);

        $objRating->IsInsert();
        // echo 'recipeID = ' . $_POST['recipeID'] . ' User_ID = ' . $_SESSION["User_ID"];

        if ($objRating->IsInsert()) {
            $objRating->Insert();
        } else {
            $objRating->Update();
        }
        $alertMsg = '<div class="row justify-content-center mt-1">
        <div class="offset-1 col-6">
        <div class="alert alert-primary alert-dismissible fade show w-75" role="alert">
        <div class="row"><div class="col-12">You rated ' . $_POST['index'] . ' out of 5.  </div></div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span></button></div></div></div>';


        $str = Rating::DisplayRating($_POST['recipeID']);
        $array = array($str, $alertMsg);
        echo json_encode($array);
    }
}
