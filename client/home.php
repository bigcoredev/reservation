<?php include("include/header.php"); 
if(!isset($_SESSION['loggedUserId'])) {
  echo "<script> window.location.href = '../index.php';</script>";
}
?>

<!-- Page Content  -->
<div class="container-fluid p-5" id="roomType">
    <div class="row justify-content-center pb-2">
        <div class="col-md-8 heading-section text-center">
            <h2 class="mt-5 pt-3">Classes</h2><BR>
            <div class="row ">
                <div class="col lg-4 mb-4">
                    <div class="row">
                        <label class="col-sm-3 col-form-label"><h5>Filter By</h5></label>
                        <div class="col-sm-7">
                            <select name="category" id="classesFilter" class="form-control custom-select bg-white border-md filter">
                                <option value="1">Class Name</option>
                                <option value="2">People</option>
                                <option value="3">Zone</option>
                                <option value="4">Location</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col lg-4 mb-4">
                    <div class="row">
                        <label class="col-sm-3 col-form-label"><h5>Search</h5></label>
                        <div class="col-sm-7">
                            <input type="text" id="search" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <Button class='btn btn-primary' id='btnsearch'>Search</Button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 mb-4">
            <div class="container" id="contentArea" style="min-height: 413px">

            </div>
        </div>
    </div>
</div>

<script src="js/home_function.js" ></script>
<?php include("include/footer.php"); ?>