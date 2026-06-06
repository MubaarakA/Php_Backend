<?php


require "../models/RadiusUser.php";
require "../models/FailedTransaction.php";



$user=new RadiusUser();


$result=$user->createOrUpdate(

$_POST['number'],
$_POST['money']

);



if(!$result){


$fail=new FailedTransaction();


$fail->create(

$_POST['number'],
$_POST['money']

);

}



header("Location:../index.php");