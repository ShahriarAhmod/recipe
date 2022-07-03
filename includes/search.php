<div class="row mt-5">
    <div class="col-6 text-center">
        <button class="btn btn-outline-info text-capitalize" type="button" data-toggle="collapse" data-target="#simpleSearchCollapse" aria-expanded="false" aria-controls="simpleSearch"><span data-toggle="tooltip" title="Simple Search">Search a recipe<i class=" ml-2 fa fa-search"></i></span></button>
    </div>
    <div class="col-6 text-center">
        <button class="btn btn-outline-info text-capitalize" type="button" data-toggle="collapse" 
        data-target="#advanceSearchCollapse" aria-expanded="false" 
        aria-controls="advanceSearch" data-toggle="tooltip" title="Advance Search">
        <span data-toggle="tooltip" title="Advance Search">Advance Search<i class=" ml-2 fa fa-search"></i></span>
        </button>
    </div>
</div>

<div class="accordion" id="accordionMain">
    <div class="row mt-2">

        <div class="col-12">
            <div class="collapse" id="simpleSearchCollapse" data-parent="#accordionMain">
                <div class="card card-body">
                    <form action="" method="POST" role="form">
                        <legend>Simple Search For recipe</legend>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">Live Search</span>
                                </div>
                                <input type="text text-capitalize" class="form-control" id="textSimple" name="textSimple" placeholder="Search A Recipe Here">
                                <!-- <div class="input-group-append">
                                    <button class="btn btn-outline-primary text-capitalize" type="submit" name="simpleSearch"><i class="fa fa-search" style="width:50px"></i></button>
                                </div> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="collapse" id="advanceSearchCollapse" data-parent="#accordionMain">
                <!-- Advance Search Start-->
                <?php include_once 'advanceSearch.php'; ?>
                <!-- Advance Search End -->
            </div>
        </div>

    </div>
</div>