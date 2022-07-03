<?php include_once '../includes/css.php' ?>
<?php include_once '../classes/User.php' ?>
<?php include_once '../classes/Database.php' ?>
<?php include_once '../classes/Message.php' ?>
<?php include_once '../classes/meal.php' ?>
<?php include_once '../classes/recipe.php' ?>
<?php include_once '../classes/meal.php' ?>
<?php include_once '../classes/category.php' ?>

<body>

    <?php

    include_once '../includes/menu.php';

    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
    <div class="container">

        <!-- <div class="row mt-3">
            <div class="col-sm">
                <div class="form-group">
                    <label for="Search" class="font-weight-bold text-capitalize">Search</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="" id="Search" placeholder="Search A Recipe Here.">
                        <div class="input-group-append">
                            <button class="btn btn-outline-info" type="button"><i class="fa fa-search" style="width: 75px"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="mainBody">
        
        </div>
        <!-- full recipe details -->

    </div>

    </div>

    <!-- <div id="processing"><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><span class='sr-only'>Loading...</span></div> -->

    <?php //include_once '../includes/login.php';  ?>
    <?php //include_once '../includes/signup.php';  ?>
    <?php include_once '../includes/js.php' ?>
    <?php //include_once '../includes/modal.php' ?>

    <script src="../js/jquery.js"></script>

    <script>
        console.log(localStorage);
        var data = localStorage.getItem('myData');
        if (data !== undefined) {
            $(".mainBody").html(data);
        }
    </script>
</body>

</html>