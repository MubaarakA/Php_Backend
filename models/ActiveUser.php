<?php

require_once __DIR__."/../config/database.php";


class ActiveUser
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


        active.username,


        active.framedipaddress,


        active.acctstarttime,





        ROUND(

            IFNULL(total.download,0)

            /1024/1024

        ,2)

        AS download,






        ROUND(

            IFNULL(total.upload,0)

            /1024/1024

        ,2)

        AS upload








        FROM



        (


            SELECT


            username,


            framedipaddress,


            acctstarttime



            FROM radacct



            WHERE acctstoptime IS NULL



        ) active








        LEFT JOIN



        (



            SELECT


            username,


            SUM(acctinputoctets) AS upload,


            SUM(acctoutputoctets) AS download




            FROM radacct




            GROUP BY username




        ) total




        ON active.username = total.username








        ORDER BY active.acctstarttime DESC


        ";






        return $this->db

        ->query($sql)

        ->fetchAll(PDO::FETCH_ASSOC);





    }




}


?>