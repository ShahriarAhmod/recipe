<?php

include_once 'menuData.php';

$brandName = isset($menu_left_data["brand"]) ? $menu_left_data["brand"]["name"] : "";
$brandLink = isset($menu_left_data["brand"]) ? $menu_left_data["brand"]["link"] : "#";

echo '<nav class="navbar navbar-expand-sm navbar-light bg-light">
<a class="navbar-brand" href="' . $brandLink . '">' . $brandName . '</a>

<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="collapsibleNavId">';

PrintMenu($menu_left_data);
PrintMenu($menu_right_data);

echo '</div>
    </nav>';


function PrintMenu($menuData)
{

    echo '<ul class="navbar-nav ' . $menuData["nav-class"] . ' mt-2 mt-lg-0">';

    foreach ($menuData["menu"] as $menu) {

        if (is_array($menu["link"])) {

            // $dropdownStyle = isset($_SESSION["Username"]) ? "dropleft" : "dropdown";

            echo ' <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $menu["name"] . '</a>
                        <div class="dropdown-menu" aria-labelledby="#">';

            if (count($menu["link"]) != 1) {
                // var_dump(count($menu["link"]));
                foreach ($menu["link"] as $link) {
                    if (array_key_exists('realPage', $link)) {
                        // True key is exist
                        echo '<a class="dropdown-item" href="' . $link["link"] . '" id="' . $link["name"] . '">' . $link["name"] . '</a>';
                    } else {
                        // false key is not exist
                        echo '<a class="dropdown-item" href="#" id="' . $link["name"] . '">' . $link["name"] . '</a>';
                    }
                }
            } else {
                // For single list of dropdown.
                // var_dump(count($menu["link"]));

                foreach ($menu["link"] as $link) {
                    echo '<a class="dropdown-item" href="' . $link["link"] . '" id="' . $link["name"] . '">' . $link["name"] . '</a>';
                }
            }

            echo '</div>
                    </li>';
        } else {

            if (isset($menu["data-target"])) {
                echo ' <li class="nav-item ">
                            <a class="nav-link"  data-toggle="modal" data-target="#' . $menu["data-target"] . '" href="' . $menu["link"] . '">' . $menu["name"] . '</a>
                        </li>';
            } else {
                echo '<li class="nav-item">
                            <a class="nav-link" href="' . $menu["link"] . '">' . $menu["name"] . '</a>
                        </li>';
            }
        }
    }
    echo '</ul>';
}
