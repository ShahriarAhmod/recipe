
<?php

include_once 'modalData.php';

PrintModal($modalLogin);
PrintModal($modalSignUp);

// '.$modal[""].'
// '.$field[""].'

function PrintModal($modal)
{

    echo '<div class="modal fade" id="' . $modal["id"] . '" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">' . $modal["name"] . '</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            
        <div class="modal-body">
        
        <form id="' . $modal["name"] . '' . $modal["id"] . '"  action="#" method="POST" role="form">';  // id="Loginmodal-login"

    foreach ($modal["fields"] as $field) {

        $fieldName = !isset($field["name"]) ? $field["title"] : $field["name"];

        echo '<div class="form-group">
                <div class="row">

                    <div class="' . $field["label_class"] . '">
                       
                        <label for="' . $modal["name"] . '' . $field["title"] . '" class="mt-1"> <span class="text-danger">* </span>' . $field["title"] . '</label>
                    </div>

                    <div class="' . $field["input_class"] . '">
                        <input type="' . $field["type"] . '" class="form-control" name="' . $fieldName . '" id="' . $modal["name"] . '' . $field["title"] . '" 
                            placeholder="' . $field["placeholder"] . '">  
                    </div>

                </div>            
             </div>';
    }

    echo '</form> ';



    echo '</div>
            <div class="modal-footer">
                <button type="submit" name="' . $modal["name"] . '" class="btn btn-primary" form="' . $modal["name"] . '' . $modal["id"] . '">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    </div>';
}


?>



    