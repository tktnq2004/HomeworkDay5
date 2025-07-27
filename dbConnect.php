<?php
const DBSERVER = 'localhost';
const DBUSER = 'root';
const DBPASS = '';
const DBNAME = 'db1';
function connectDB()
{                $conn = new mysqli(DBSERVER,DBUSER,DBPASS,DBNAME);
                if ($conn->connect_error){
                    die('Connection failed: '. $conn->connect_error);
                }
                return $conn;
}
 ?>