<?php
include_once 'meal.php';
include_once 'rating.php';


// SELECT COLUMN_NAME FROM information_schema.columns WHERE table_schema = 'project_db' AND TABLE_NAME = 'recipe'
class Recipe
{
    private $name;
    private $imageName;
    private $mealId;
    private $recipeDate;
    private $preparationTime;
    private $cookingTime;
    private $servings;

    // Insert Start
    public function Insert()
    {
        try {
            $database = Database::GetInstance();
            $query = "INSERT INTO Car (name, imageName, mealId, recipeDate, preparationTime, cookingTime, servings)";
            $query .= " VALUES(?,?,?,?,?,?,?,?,?)";
            $connection = $database->Get_Connection();
            $statement  = $connection->prepare($query);
            $statement->bindParam(1, $this->name);
            $statement->bindParam(2, $this->imageName);
            $statement->bindParam(3, $this->mealId);
            $statement->bindParam(4, $this->recipeDate);
            $statement->bindParam(5, $this->preparationTime);
            $statement->bindParam(6, $this->cookingTime);
            $statement->bindParam(7, $this->servings);

            $statement->execute();
            //echo "User inserted ID = ".$connection->lastInsertId();

        } catch (PDOException $e) {
            echo "INSERT Query Failed : " . $e->getMessage();
        }
    }
    // Insert End

    // Readrecipe Start
    //? Important: empty() -> "" , 0, 0.0, "0", NULL, FALSE, array() (an empty array) ====> TRUE 
    public static function ReadRecipe($mealname = "", $categoryName = "", $recipeId = "")
    {
        try {
            $result = '';
            $database = Database::GetInstance();
            $connection = $database->Get_Connection();

            if (!empty($mealname)) {
                // for meal (Meal)
                $query = "SELECT recipe.* from recipe ";
                $query .= " join meal on recipe.meal_id = meal.meal_id ";
                $query .= " WHERE meal.name = '$mealname' AND recipe.active = 1";
            } else if (!empty($categoryName)) {
                // for catagoty (categoty)
                $query = "SELECT recipe.* FROM recipe ";
                $query .= " JOIN recipe_categories ON recipe.recipe_id = recipe_categories.recipe_id ";
                $query .= " JOIN  categories ON recipe_categories.category_id = categories.category_id ";
                $query .= " WHERE categories.name = '$categoryName' AND recipe.active = 1 ";
            } else if (!empty($recipeId)) {
                // for Full Details of perticular recipe
                $query = "SELECT * FROM recipe WHERE recipe_id = $recipeId AND active = 1";
                $query1 = "SELECT * FROM ingredient WHERE recipe_id = $recipeId";
                $query2 = "SELECT * FROM preparation WHERE recipe_id = $recipeId";


                // $statement  = $connection->prepare("SELECT * FROM recipe WHERE recipe_id = $recipeId AND active = 1;
                // SELECT * FROM ingredient WHERE recipe_id = $recipeId;
                // SELECT * FROM preparation WHERE recipe_id = $recipeId");

                $statement  = $connection->prepare("$query;$query1;$query2");
                $statement->execute();

                $result1 = $statement->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($result1);
                $statement->nextRowset();
                $result2 = $statement->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($result2);
                $statement->nextRowset();
                $result3 = $statement->fetchAll(PDO::FETCH_ASSOC);
                // var_dump($result3);

                return array($result1, $result2, $result3);

                // $query = "SELECT * FROM recipe ";
                // $query .= " JOIN ingredient ON recipe.recipe_id = ingredient.recipe_id ";
                // $query .= " JOIN preparation ON recipe.recipe_id = preparation.recipe_id ";
                // $query .= " WHERE recipe.recipe_id = $fullDetailRecipeId AND recipe.active = 1 ";
            } else {
                // for main page display all
                $query = "SELECT * FROM recipe WHERE active = 1";
            }

            $statement  = $connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            // print_r($result);
            return $result;
        } catch (PDOException $e) {
            echo "ReadRecipe Query Failed: " . $e->getMessage();
            return $result;
        }
    }
    // Readrecipe End

    // SearchQuery Start
    //? parameter 1 => simple query Data not whole Query , parameter 2 => whole advance Query
    public static function SearchQuery($simpleQueryData = "", $queryAdvance = "")
    {
        try {
            $database = Database::GetInstance();
            $connection = $database->Get_Connection();
            if (empty($queryAdvance) && !empty($simpleQueryData)) {
                $query = "SELECT * FROM recipe WHERE name LIKE '%$simpleQueryData%'";
            } else {
                $query = $queryAdvance;
            }
            $statement  = $connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($result);
            return $result;
        } catch (PDOException $e) {
            echo "SearchQuery Query Failed: " . $e->getMessage();
            return $result;
        }
    }
    // SearchQuery End

    // ConvertQuery Start
    public static function ConvertQuery($queryFirst, $querySecond, $condtionOP)
    {
        $queryFirst = str_replace('recipe.*', 'recipe.recipe_id', $queryFirst);
        $querySecond = str_replace('recipe.*', 'recipe.recipe_id', $querySecond);

        $query = " SELECT * FROM recipe ";
        $query .= " WHERE recipe_id IN ( $queryFirst ) ";
        $query .= " $condtionOP ";
        $query .= " recipe_id IN ( $querySecond ) ";

        return $query;
    }
    // ConvertQuery End 

    // GenerateQuery Start
    public static function GenerateQuery($advanceField, $advanceFilter, $textAdvance)
    {

        $query = "";

        switch ($advanceField) {
            case 1:
                // Recipe
                $query .= " SELECT recipe.* FROM recipe WHERE name ";
                break;
            case 2:
                // Meal Type
                $query .= " SELECT recipe.* FROM recipe ";
                $query .= " JOIN meal ON recipe.meal_id = meal.meal_id ";
                $query .= " WHERE meal.name ";
                break;
            case 3:
                // Category
                $query .= " SELECT recipe.* FROM recipe ";
                $query .= " JOIN recipe_categories ON recipe.recipe_id = recipe_categories.recipe_id ";
                $query .= " JOIN categories ON recipe_categories.category_id = categories.category_id ";
                $query .= " WHERE categories.name ";
                break;
            case 4:
                // ingredient
                $query .= " SELECT recipe.* FROM recipe ";
                $query .= " JOIN ingredient ON recipe.recipe_id = ingredient.recipe_id ";
                $query .= " WHERE ingredient.name ";
                break;

            default:
        }
        switch ($advanceFilter) {
            case 1:
                // Start With
                $query .= "LIKE '$textAdvance%' ";
                break;
            case 2:
                // End With
                $query .= "LIKE '%$textAdvance' ";
                break;
            case 3:
                // Equals
                $query .= "LIKE '$textAdvance' ";
                break;
            case 4:
                // Contains
                $query .= "LIKE '%$textAdvance%' ";
                break;
            case 5:
                // Does not Start with
                $query .= "NOT LIKE '$textAdvance%' ";
                break;
            case 6:
                // Does not End with
                $query .= "NOT LIKE '%$textAdvance' ";
                break;
            case 7:
                // Does not Equal to
                $query .= "NOT LIKE '%$textAdvance' ";
                break;
            case 8:
                // Does not Contains
                $query .= "NOT LIKE '%$textAdvance%' ";
                break;

            default:
        }
        return $query;
    }
    // GenerateQuery End

    // DisplayRecipe Start
    public static function DisplayRecipeCard($array, $isReturn = false)
    {
        if (count($array) != 0) {

            $string = '<div class="row mb-2 mt-5">';

            foreach ($array as $recipe) {
                // $recipe['']
                $string = $string . '<div class="col-lg-6 mb-4">
                <div class="card border-secondary">
                    <div class="card-body" id="recipeCard">
                        <div class="row ">
                            <div class="col-7">
                                <strong class="d-inline-block mb-2 text-success text-capitalize">Meal : ' . Meal::MealMenu($recipe['meal_id']) . '</strong>
                                <h5 class="mb-1">
                                    <a class="text-dark text-capitalize" id="' . $recipe['recipe_id'] . '" href="#">' . $recipe['name'] . '</a>
                                </h5>
                                <div class="mb-1" id="recipeRating-' . $recipe['recipe_id'] . '">' .
                    Rating::DisplayRating($recipe['recipe_id'])
                    . '</div>
                                <div class="mb-1 text-muted">' . $recipe['recipe_date'] . '</div>
                                <div class="mb-1 text-muted">Preparation Time : ' . $recipe['preparation_time'] . '</div>
                                <div class="mb-1 text-muted">Cooking Time : ' . $recipe['cooking_time'] . '</div>
                                <div class="mb-1 text-muted">Servings : ' . $recipe['servings'] . '</div>

                                <a class="text-capitalize" id="' . $recipe['recipe_id'] . '" href="#">Continue reading</a>
                            </div>  
                            <div class="col-5">
                                <img class="img-thumbnail" src="./image/' . $recipe['image_name'] . '" style="width: 200px; height: 250px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }
            $string = $string . ' </div>';

            if ($isReturn != false) {
                return $string;
            } else {
                echo $string;
            }
        } else {
            return 0;
        }
    }
    // DisplayRecipe End

    //DisplayRecipeFullInfo Start
    public static function DisplayRecipeFullInfo($recipeId)
    {
        $array = self::ReadRecipe(0, 0, $recipeId);
        // var_dump($array);
        $recipe = $array[0][0];
        // var_dump($recipe);
        $ingredient = $array[1];
        // var_dump($ingredient);
        $preparation = $array[2];
        // var_dump($preparation);

        $str = '<div class="row mt-5">';

        $str .= '<div class="col-sm-3 text-center">
                    <img class="img-thumbnail" src="./image/' . $recipe['image_name'] . '" style="width:270px;height:340px">

                    <div class="ml-1 mt-3">

                        <h6 class="mb-1 text-muted">Meal : ' . $recipe['meal_id'] . '</h6>
                        <h6 class="mb-1 text-muted">' . $recipe['recipe_date'] . '</h6>
                        <h6 class="mb-1 text-muted">Preparation Time : ' . $recipe['preparation_time'] . '</h6>
                        <h6 class="mb-1 text-muted">Cooking Time : ' . $recipe['cooking_time'] . '</h6>
                        <h6 class="mb-1 text-muted">Servings : ' . $recipe['servings'] . '</h6> 
                        <div class="mb-1 ml-5" id="recipeRating-' . $recipe['recipe_id'] . '">' .
                        Rating::DisplayRating($recipe['recipe_id'])
                        . '</div>
                    </div>
                </div>';

        $str .= '<div class="col-sm-9">';

        $str .= '<div class="row">
                    <div class="col-12">
                    <h1 class="text-center text-capitalize">' . $recipe['name'] . '</h1>
                    </div>
                </div>';

        $str .= '<div class="row mt-3">
                <div class="col-sm-6">';

        $str .= '<h4 class="text-center mb-4 text-capitalize">ingredients</h4>

                <table class="table table-hover">
                <thead>
                <tr>
                <th scope="col" class="text-center text-capitalize">#</th>
                <th scope="col" class="text-center text-capitalize">List</th>
                </tr>
                </thead>
                <tbody>';

        foreach ($ingredient as $key => $value) {
            $str .= ' <tr>
                <th scope="row">' . ($key + 1) . '</th>
                <td>' . $value['quantity'] . ' ' . $value['name'] . '</td>
                </tr>';
        }

        $str .= '</tbody>
        </table>
        </div>
        <div class="col-sm-6">
        <h4 class="text-center mb-4 text-capitalize">preperation</h4>
        <table class="table table-hover">
        <thead>
        <tr>
        <th scope="col" class="text-center text-capitalize">#</th>
        <th scope="col" class="text-center text-capitalize">List</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($preparation as $key => $value) {
            $str .= ' <tr>
            <th scope="row">' . $value['step_number'] . '</th>
            <td>' . $value['step_name'] . ' </td>
            </tr>';
        }
        $str .= '</tbody>
        </table>
        </div>
        </div>
        </div>
        </div>';

        return $str;
    }
    //DisplayRecipeFullInfo End
}
