$(document).ready(function () {

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]'
    });

    $('.alert-link').on('click', function () {
        $("button.close").click();
    });

    function Processing(state) {
        if (state) {
            $("#processing").css("display", "block");
        } else {
            $("#processing").css("display", "none");
        }
    }

    $(document).on('click', '.dropdown-item', function () {
        // $('.dropdown-item').on('click', function (event) {  ----> Do not use this function this 
        // not work for dynamically added element
        dropdownItem = $(this).attr('id');
        dropdownTitle = $(this).closest('li').find('.nav-link').text();
        // alert(dropdownItem + " \n\n" + dropdownTitle);
        if (dropdownItem != 'Logout') {
            $.ajax({
                type: "POST",
                url: "./mealDetails.php",
                beforeSend: function () {
                    Processing(true);
                },
                data: {
                    menuDropDown: '',
                    menuItemName: dropdownItem,
                    mainMenuName: dropdownTitle
                },
                dataType: "html",
                success: function (response) {
                    Processing(false);
                    // console.log(response + '\n');
                    // console.log(JSON.parse(response));
                    var json_ob = JSON.parse(response);
                    $(".mainBody").html(json_ob);
                },
                error: function (response) {
                    console.log(response);
                    // $(".mainBody").html(response);
                }
            });
        }
    });

    $(document).on('click', 'div#recipeCard.card-body a', function () {
        // $('div#recipeCard.card-body a').live('click', function () {   ----> Do not use this function this 
        // not work for dynamically added element
        
        selectCardId = $(this).attr('id');
        // alert(selectCardId);

        $.ajax({
            type: "POST",
            url: "./mealDetails.php",
            beforeSend: function () {
                Processing(true);
            },
            data: {
                fullRecipeDetail: '',
                cardId: selectCardId
            },
            dataType: "html",
            success: function (response) {
                Processing(false);
                // console.log(response + '\n');
                // console.log(JSON.parse(response));
                // var json_ob = JSON.parse(    response);
                // $(".mainBody").html(response);
                localStorage.setItem('myData', response);
                window.location.href = "./recipeDetails.php";
            },
            error: function (response) {
                // console.log(response);
                // $(".mainBody").html(response);
            }
        });
    });

    var delayTimer = null;
    $(document).on('keyup', '#textSimple', function () {
        data = this.value;
        clearTimeout(delayTimer);
        delayTimer = setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "./mealDetails.php",
                beforeSend: function () {
                    Processing(true);
                },
                data: {
                    simpleSearch: '',
                    queryData: data
                },
                success: function (response) {
                    Processing(false);
                    // console.log(response);
                    var json_ob = JSON.parse(response);
                    // console.log(json_ob);
                    $(".mainBody").html(json_ob);
                }
            });
        }, 2000);
    });

    $(document).on('click', '.rating', function () {

        index = $(this).data("index");
        recipeID = $(this).data("recipeid");
        ratingStarBody = $(this).closest('.mb-1').attr('id');
        // $('[data-toggle="tooltip"]').tooltip();
        $('#' + recipeID + '-' + index).tooltip('dispose');
        // alert('#' + ratingStarBody);

        $.ajax({
            type: "POST",
            url: "./mealDetails.php",
            beforeSend: function () {
                Processing(true);
            },
            data: {
                ratingClick: '',
                index: index,
                recipeID: recipeID,
            },
            success: function (response) {
                Processing(false);

                // console.log(response);
                console.log(JSON.parse(response));

                var json_ob = JSON.parse(response);
                if (Array.isArray(json_ob)) {
                    ratingStar = json_ob[0];
                    ratingAlert = json_ob[1];
                    // console.log(ratingStar);
                    // console.log(ratingAlert);
                    $(".ratingAlertBody").html(ratingStar);
                    $('#' + ratingStarBody).html(ratingStar);
                } else {
                    $(".ratingAlertBody").html(json_ob);
                }

            },
            error: function (response) {
                console.log(response);
            }
        });

    });

    $(document).on('mouseenter', '.rating', function () {
        var index = $(this).data("index");
        var recipeid = $(this).data('recipeid');
        // alert(index);
        // $(this).addClass("fa-star-o");
        for (var count = 1; count <= index; count++) {
            $('#' + recipeid + '-' + count).css('color', 'blue').removeClass("fa-star fa-star-half").addClass("fa-star-o");
        }
    });

    $(document).on('mouseleave', '.rating', function () {
        var index = $(this).data("index");
        var recipeid = $(this).data('recipeid');
        // alert(index);
        $('[data-star="fullStar"]').removeClass("fa-star-o").addClass("fa-star");
        $('[data-star="halfStar"]').removeClass("fa-star-o").addClass("fa-star-half");
        $('[data-star="emptyStar"]').removeClass("fa-star-o").addClass("fa-star-o");

        for (var count = 1; count <= index; count++) {
            $('#' + recipeid + '-' + count).css('color', 'black');
        }
    });
});