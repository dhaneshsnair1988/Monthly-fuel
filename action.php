<?php
session_start();
include 'Fuel.php';
$invoice = new Fuel();

if($_GET['action'] == 'logout') {
session_unset();
session_destroy();
header("Location:index.php");
}

