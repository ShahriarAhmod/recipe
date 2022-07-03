<?php
include_once 'recipe.php';

class Category
{
    private $categoryId;
    private $name;

    function Meal($categoryId, $name)
    {
        $this->categoryId = $categoryId;
        $this->name = $name;
    }

    public function Insert()
    {
        try {
            $database = Database::GetInstance();
            $query = "INSERT INTO users (categoryId,name)";
            $query .= " VALUES(?,?,?,?,?,?,?)";
            $connection = $database->Get_Connection();
            $statement  = $connection->prepare($query);
            $statement->bindParam(1, $this->categoryId);
            $statement->bindParam(2, $this->name);

            $statement->execute();
            // echo "User inserted ID = ".$connection->lastInsertId();

        } catch (PDOException $e) {
            echo get_class() . "INSERT Query Failed : " . $e->getMessage();
        }
    }

    // CategoryMenu Start
    public static function CategoryMenu()
    {
        try {
            $database = Database::GetInstance();
            $connection = $database->Get_Connection();

            $query = "SELECT name FROM categories where active = 1";
            $statement  = $connection->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as $key => $value) {
                $result[$key]["link"] = str_replace(' ', '', $value["name"]) . '.php';
            }

            return $result;
        } catch (PDOException $e) {
            echo "CategoryMenu Query Failed : " . $e->getMessage();
        }
    }
    // CategoryMenu End

}
