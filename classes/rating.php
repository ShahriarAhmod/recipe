<?php
require_once "Database.php";

class Rating
{
    private $recipeID;
    private $userID;
    private $rating;

    function Rating($recipeID, $userID, $rating)
    {
        $this->recipeID = $recipeID;
        $this->userID = $userID;
        $this->rating = $rating;
    }

    public function Insert()
    {
        try {
            $database = Database::GetInstance();
            $connection = $database->Get_Connection();
            $query = "INSERT INTO rating (recipe_id, user_id, rating)";
            $query .= " VALUES(?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $this->recipeID);
            $stmt->bindParam(2, $this->userID);
            $stmt->bindParam(3, $this->rating);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function Update()
    {
        // UPDATE `rating` SET `user_id`=[value-1],`recipe_id`=[value-2],`rating`=[value-3] WHERE 1
        try {
            $database = Database::GetInstance();
            $connection = $database->Get_Connection();
            $query = " Update rating SET rating = (?) where user_id = (?) AND recipe_id = (?) ";
            $stmt = $connection->prepare($query);
            $stmt->bindParam(1, $this->rating);
            $stmt->bindParam(2, $this->userID);
            $stmt->bindParam(3, $this->recipeID);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function IsInsert()
    {
        // UPDATE `rating` SET `user_id`=[value-1],`recipe_id`=[value-2],`rating`=[value-3] WHERE 1
        try {
            $database = Database::GetInstance();
            $query = "SELECT COUNT(*) FROM rating WHERE user_id = (?) AND recipe_id = (?)";

            $connection = $database->Get_Connection();
            $statement = $connection->prepare($query);
            $statement->bindParam(1, $this->userID);
            $statement->bindParam(2, $this->recipeID);
            $statement->execute();
            // $result = $statement->columnCount();
            $result = $statement->fetchColumn();

            // var_dump((int)$result !== 0);

            if ((int) $result !== 0) {
                return false;   // Data is exist in the table
            }

            return true;       // Data is not exist in the table
        } catch (PDOException $e) {
            echo "INSERT Query Failed : " . $e->getMessage();
        }
    }

    public static function Calculate_Rating($recipeID)
    {
        try {
            $query = "SELECT AVG(rating) FROM rating WHERE recipe_id = $recipeID";
            $database = Database::GetInstance();
            $connection = $database->Get_Connection();
            $statement  = $connection->prepare($query);
            $statement->execute();

            // $result = $statement->fetch(PDO::FETCH_ASSOC);
            $result = $statement->fetchColumn();

            return $result;
        } catch (PDOException $e) {
            echo "Query Failed : " . $e->getMessage();
        }
    }

    public static function DisplayRating($recipeID)
    {
        //! printing sequence is fullStar, halfStar, emptyStar.
        $random = rand(0, 1000000);
        $rating = self::Calculate_Rating($recipeID);

        $full_stars = floor($rating);
        $empty_stars = 5 - $full_stars;

        $starIndex = $full_stars != 0 ? $full_stars + 1 : $full_stars;

        $str = '<div class="row">';

        for ($i = 1; $i <= $full_stars; $i++) {
            $str .= '<div class="col-1">';
            $str .= '<i class="fa fa-star rating" data-index="' . $i . '" data-recipeID="' . $recipeID . '" data-star="fullStar" id="' . $recipeID . '-' . $i . '" data-toggle="tooltip" data-placement="bottom" title="' . $i . '"></i>';
            $str .= '</div>';
        }

        //Display half star
        if ($rating - $full_stars > 0) {
            $str .= '<div class="col-1">';
            $str .= '<i class="fa fa-star-half rating" data-index="' . ($starIndex) . '" data-recipeID="' . $recipeID . '" data-star="halfStar" id="' . $recipeID . '-' . ($starIndex) . '" data-toggle="tooltip" data-placement="bottom" title="' . $starIndex . '"></i>';
            $str .= '</div>';
            $empty_stars--;
        } else {
            $starIndex--; //! go back to previous index (We don't have halfStar).
        }

        if ($empty_stars == 5) {
            $starIndex = 0;         //! set index to zero ( 0 -> full start , 0 -> half start)
        }

        //Display empty stars
        for ($i = 1; $i <= $empty_stars; $i++) {
            $str .= '<div class="col-1">';
            $str .= '<i class="fa fa-star-o rating" data-index="' . ($starIndex + $i) . '" data-recipeID="' . $recipeID . '" data-star="emptyStar" id="' . $recipeID . '-' . ($starIndex + $i) . '" data-toggle="tooltip" data-placement="bottom" title="' . ($starIndex + $i) . '"></i>';
            $str .= '</div>';
        }
        $str .= '</div>';
        return $str;
    }
}
