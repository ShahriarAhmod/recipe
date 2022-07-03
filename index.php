<?php ob_start(); ?>
<?php include_once './includes/css.php' ?>
<?php include_once './classes/User.php' ?>
<?php include_once './classes/Message.php' ?>
<?php include_once './classes/recipe.php' ?>

<body>

    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once './includes/menu.php';
    include_once './includes/login.php';
    include_once './includes/signup.php';
    ?>
    <!-- container Start -->
    <div class="container">

        <!-- Search Start -->
        <?php include_once './includes/search.php'; ?>
        <!-- Search End -->

        <!-- ratingBody Start -->
        <div class="ratingAlertBody mt-3">
        </div>
        <!-- ratingBody End -->

        <!-- mainBody Start -->
        <div class="mainBody">

            <?php

            if (isset($_POST['advanceSearch'])) {
                if ($_POST['Condition'] != 0) {
                    // advance search with and or condition
                    if (
                        $_POST['advanceFieldAndOr'] != 0 && $_POST['advanceFilterAndOr'] != 0 && !empty($_POST['textAdvanceAndOr']) &&
                        $_POST['advanceField'] != 0 && $_POST['advanceFilter'] != 0 && !empty($_POST['textAdvance'])
                    ) {
                        // echo $_POST['advanceFieldAndOr'] . '  ' . $_POST['advanceFilterAndOr'];

                        $condtionOP = "";
                        if ($_POST['Condition'] == 1) {
                            $condtionOP = " AND ";
                        } else {
                            $condtionOP = " OR ";
                        }

                        $queryFirst = Recipe::GenerateQuery($_POST['advanceField'], $_POST['advanceFilter'], $_POST['textAdvance']);
                        $querySecond = Recipe::GenerateQuery($_POST['advanceFieldAndOr'], $_POST['advanceFilterAndOr'], $_POST['textAdvanceAndOr']);

                        $query = Recipe::ConvertQuery($queryFirst, $querySecond, $condtionOP);
                        // var_dump($query);
                        $array = Recipe::SearchQuery(0, $query);
                        Recipe::DisplayRecipeCard($array);
                    }
                } else {
                    // advance search
                    if ($_POST['advanceField'] != 0 && $_POST['advanceFilter'] != 0 && !empty($_POST['textAdvance'])) {
                        // echo $_POST['advanceField'] . '  ' . $_POST['advanceFilter'];
                        $query = Recipe::GenerateQuery($_POST['advanceField'], $_POST['advanceFilter'], $_POST['textAdvance']);
                        // var_dump($query);
                        $array = Recipe::SearchQuery(0, $query);
                        Recipe::DisplayRecipeCard($array);
                    }
                }
            } else {
                Recipe::DisplayRecipeCard(Recipe::ReadRecipe());
            }

            ?>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

        </div>
        <!-- mainBody End -->

    </div>

    <!-- Footer -->
    <footer class="container-fluid w-100 bg-dark text-light py-3">
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2018 Copyright:
            <a href="#">Recipe</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

    <!-- container End -->
    <div id="processing"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><span class="sr-only">Loading...</span></div>

    <?php include_once './includes/js.php' ?>
    <?php include_once './includes/modal.php' ?>
    <script src="./js/jquery.js?<?php echo $random ?>"></script>
</body>

</html>