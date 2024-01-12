<?php
require 'core/dbconnect.php';


if(isset($_GET['id'])){
    $id2=$_GET['id'];
$sql=$database->prepare("SELECT * FROM catogry WHERE id=:get_id");
$sql->bindParam("get_id",$id2);
$sql->execute();
if($sql->rowCount() == 1){
    var_dump($sql->fetch(PDO::FETCH_ASSOC));

//var_dump($rows);
}

 }