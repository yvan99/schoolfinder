<?php
require('Backend.php');
if (isset($_POST['request'])) {
    $address = $_POST['user_address'];
    $category = $_POST['schoolCategory'];
    $schoolType= $_POST['schoolType'];

    if (!empty($address) && !empty($category) && !empty($schoolType)) {
        $connectBackend = new Backend;
        $sendData = $connectBackend->getSchools($address,$schoolType,$category);     
    }
    else{
        die("Backend refused to connect");
    }
}
