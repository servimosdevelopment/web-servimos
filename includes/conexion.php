<?php

$host ='localhost';
$user='juan';
$db='contracts';
$pass='Juan123@';
  
try{
   $con = new PDO('mysql:host='.$host.';dbname='.$db.';charset=utf8',$user,$pass);
   $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    "error al conectar".$e->getMessage();
}

?>
