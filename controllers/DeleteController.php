<?php


require "../models/RadiusUser.php";


$user=new RadiusUser();


$user->delete($_GET['user']);


header("Location:../index.php");
