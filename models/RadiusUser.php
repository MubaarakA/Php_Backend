<?php

require_once __DIR__."/../config/database.php";


class RadiusUser
{

private $db;


public function __construct()
{
    $this->db = Database::connect();
}





public function all()
{


$sql = "

SELECT


r.username,



MAX(
CASE
WHEN r.attribute='Cleartext-Password'
THEN r.value
END
) password,




MAX(
CASE
WHEN r.attribute='Expiration'
THEN r.value
END
) expiration,





ROUND(

IFNULL(stats.upload,0)

/1024/1024,2

) upload,






ROUND(

IFNULL(stats.download,0)

/1024/1024,2

) download,






MAX(
CASE
WHEN rr.attribute='Mikrotik-Rate-Limit'
THEN rr.value
END
) speed,






CASE

WHEN online.username IS NOT NULL

THEN 'online'

ELSE 'offline'

END status







FROM radcheck r




LEFT JOIN radreply rr

ON r.username=rr.username






LEFT JOIN

(

SELECT

username,

SUM(acctinputoctets) upload,

SUM(acctoutputoctets) download


FROM radacct

GROUP BY username


) stats


ON r.username=stats.username







LEFT JOIN

(

SELECT DISTINCT username

FROM radacct

WHERE acctstoptime IS NULL


) online


ON r.username=online.username






GROUP BY r.username


";



return $this->db
->query($sql)
->fetchAll(PDO::FETCH_ASSOC);



}








public function createOrUpdate($number,$money)
{


if($money=="0.50"){

$duration="+30 minutes";

}

elseif($money=="1.00"){

$duration="+1 hour";

}

else{

return false;

}




$expiration=date(

"M d Y h:i:s A",

strtotime($duration)

);





$check=$this->db->prepare(

"SELECT id FROM radcheck

WHERE username=?

LIMIT 1"

);


$check->execute([$number]);





if($check->rowCount()>0){



$this->db->prepare(

"UPDATE radcheck

SET value=?

WHERE username=?

AND attribute='Expiration'"


)->execute([

$expiration,

$number

]);



}else{





$this->db->prepare(

"INSERT INTO radcheck

(username,attribute,op,value)

VALUES

(?,'Cleartext-Password',':=','123')"


)->execute([$number]);








$this->db->prepare(

"INSERT INTO radcheck

(username,attribute,op,value)

VALUES

(?,'Expiration',':=',?)"


)->execute([

$number,

$expiration

]);








$this->db->prepare(

"INSERT INTO radreply

(username,attribute,op,value)

VALUES

(?,'Mikrotik-Rate-Limit',':=','10M/10M')"


)->execute([$number]);



}


return true;


}







public function delete($username)
{


$this->db->prepare(

"DELETE FROM radcheck WHERE username=?"

)->execute([$username]);



$this->db->prepare(

"DELETE FROM radreply WHERE username=?"

)->execute([$username]);



}



}

?>