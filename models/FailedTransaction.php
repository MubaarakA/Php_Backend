<?php

require_once __DIR__."/../config/database.php";


class FailedTransaction
{


private $db;


function __construct()
{

$this->db=Database::connect();

}





public function create($number,$money)
{


$this->db->prepare(

"INSERT INTO failed_transactions

(number,money,status)

VALUES

(?,?,?)"


)->execute([

$number,
$money,
"Invalid Plan"

]);

}






public function all()
{


return $this->db
->query(

"SELECT * FROM failed_transactions
ORDER BY id DESC"

)
->fetchAll(PDO::FETCH_ASSOC);



}


}