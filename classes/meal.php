<?php
include_once "Database.php";
include_once "recipe.php";

class Meal
{

    private $mealId;
    private $name;

    function Meal($mealId, $name)
    {
        $this->mealId = $mealId;
        $this->name = $name;
    }

    public function Insert()
    {
        try {
            $database = Database::GetInstance();
            $query = "INSERT INTO users (mealId,name)";
            $query .= " VALUES(?,?,?,?,?,?,?)";
            $connection = $database->Get_Connection();
            $statement  = $connection->prepare($query);
            $statement->bindParam(1, $this->mealId);
            $statement->bindParam(2, $this->name);

            $statement->execute();
            // echo "User inserted ID = ".$connection->lastInsertId();

        } catch (PDOException $e) {
            echo get_class() . "INSERT Query Failed : " . $e->getMessage();
        }
    }

    // MealMenu Start
    public static function MealMenu($mealId = "")
    {
        try {
            $database = Database::GetInstance();
            $connection = $database->Get_Connection();

            if (empty($mealId)) {
                $query = "SELECT name FROM meal where active = 1 ";
                $statement  = $connection->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $key => $value) {
                    $result[$key]["link"] = str_replace(' ', '', $value["name"]) . '.php';
                }

                return $result;
            } else {
                // Use in DisplayRecipe Function in recipe.php.
                $query = "SELECT name FROM meal where active = 1 and meal_id = $mealId";
                $statement  = $connection->prepare($query);
                $statement->execute();
                $result = $statement->fetchColumn();
                return $result;
            }
        } catch (PDOException $e) {
            echo "Encrypt Query Failed : " . $e->getMessage();
        }
    }
    // MealMenu End
}
