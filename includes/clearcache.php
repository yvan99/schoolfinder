<?php
session_start();
if ($_SESSION['schools']) {
    session_destroy();
    header("location:../find.php");
}
