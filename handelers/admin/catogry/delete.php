<?php 

require "../../../core/dbconnect.php";




if(isset($_GET['id'])){

    $catogry_id=$_GET['id'];


    

   
        $deletcatogry=$database->prepare("DELETE  FROM catogry WHERE id=:cat_id ");

        $deletcatogry->bindParam("cat_id",$catogry_id);

        if($deletcatogry->execute()){

            $_SESSION['message_delete']="catogry deleted successfully";

            header("location:../../../view/admin/all_catogries.php");
   
}
}