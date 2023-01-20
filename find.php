<?php
// call css file
require_once('includes/css.php');
require_once('includes/navbar.php');
session_start();
?>

<link rel="stylesheet" href="assets/css/find.css">
<style>
    body{
        text-transform: capitalize !important;
    }
</style>
<div class="container">
<form action="backend/forms.php" method="post">
    <div class="row height d-flex justify-content-center align-items-center col-12 row">
        <span class="mb-2 h3">Find Nearest School</span>
        <div class="col-md-3">
            <div class="form mt-3">
                <i class="fa fa-search"></i>
                <input type="text" name="user_address" id="locationTextField" class="form-control form-input" placeholder="Tell Us where you are...">
                <!-- <span class="left-pan"><i class="fa fa-microphone"></i></span> -->
            </div>
        </div>
        <div class="col-md-3">
            <select name="schoolType"  class="form-control form-input mt-3 form-select">
                <option selected disabled>Select school type</option>
                <option value="private" >Private</option>
                <option value="public" >Public</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="schoolCategory"  class="form-control form-input mt-3 form-select">
                <option selected disabled>Select school type</option>
                <option value="primary" >Primary school</option>
                <option value="nursery" >Nursery school</option>
            </select>
        </div>


        <div class="col-md-3">
            <button type="submit" name="request" class="btn btn-primary form-input mt-3">Find Nearest Schools</button>
        </div>

    </div>
    </form>

    <div id="map"style="width: 93%; height: 100vh;"></div>
    

</div>


<?php
// call css file
require_once('includes/script.php');
?>
<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>

<?php
// call css file
require_once('includes/mapScripts.php');
?>

