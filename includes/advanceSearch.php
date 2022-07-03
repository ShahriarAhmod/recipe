<div class="card card-body">
    <form action="#" method="POST" role="form">
        <legend>Advance Search</legend>
        <div class="form-group">
            <!-- Advance Without Condition Start-->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <select name="advanceField" class="custom-select">
                        <option value="0" selected>Select Field</option>
                        <option value="1">Recipe</option>
                        <option value="2">Meal Type</option>
                        <option value="3">Category</option>
                        <option value="4">ingredient</option>
                    </select>
                </div>
                <div class="input-group-prepend">
                    <select name="advanceFilter" class="custom-select">
                        <option value="0" selected>Select Filter</option>
                        <option value="1">Starts With</option>
                        <option value="2">ends with</option>
                        <option value="3">equals</option>
                        <option value="4">contains</option>
                        <option value="5">does not starts With</option>
                        <option value="6">does not ends with</option>
                        <option value="7">does not equal to</option>
                        <option value="8">does not contains</option>
                    </select>
                </div>
                <input type="text text-capitalize" class="form-control" name="textAdvance" placeholder="Advance Search">
            </div>
        </div>

        <div class="row">
            <div class="col-4 text-center">
                <div class="form-group">
                    <button class="btn btn-outline-danger text-capitalize" type="button" data-toggle="collapse" data-target="#AdvanceAndOrCollapse" aria-expanded="false" aria-controls="AdvanceAndOrCollapse">Add Another Criteria</button>
                </div>
            </div>
            <div class="col-8 text-center">
                <div class="form-group">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="noCondition" name="Condition" class="custom-control-input" value="0" checked>
                        <label class="custom-control-label" for="noCondition">No Condition</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="andCondition" name="Condition" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="andCondition">AND Condition</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="orCondition" name="Condition" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="orCondition">OR Condition</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse" id="AdvanceAndOrCollapse">
            <div class="form-group">
                <!-- Advance Without Condition Start-->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select name="advanceFieldAndOr" class="custom-select">
                            <option value="0" selected>Select Field</option>
                            <option value="1">Recipe</option>
                            <option value="2">Meal Type</option>
                            <option value="3">Category</option>
                            <option value="4">ingredient</option>
                        </select>
                    </div>
                    <div class="input-group-prepend">
                        <select name="advanceFilterAndOr" class="custom-select">
                            <option value="0" selected>Select Filter</option>
                            <option value="1">Starts With</option>
                            <option value="2">ends with</option>
                            <option value="3">equals</option>
                            <option value="4">contains</option>
                            <option value="5">does not starts With</option>
                            <option value="6">does not ends with</option>
                            <option value="7">does not equal to</option>
                            <option value="8">does not contains</option>
                        </select>
                    </div>
                    <input type="text text-capitalize" class="form-control" name="textAdvanceAndOr" placeholder="Advance Search">
                </div>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-outline-primary text-capitalize form-control" id="advanceSearchBtn" type="submit" name="advanceSearch"><i class="fa fa-search" style="width:50px"></i></button>
        </div>
    </form>
</div>