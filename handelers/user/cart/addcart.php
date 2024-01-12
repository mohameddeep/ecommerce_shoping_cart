<?php 

session_start();
if(isset($_GET['id'])){
    $id=$_GET['id'];

    if(isset($_GET['quantity'])){
        $quantity=$_GET['quantity'];
    }else{

        $quantity=1;

    }


    $_SESSION['cart'][$id]=array(
        "quantity"=>$quantity
    );
// echo "<pre>";
//     print_r($_SESSION['cart']);
//     echo "</pre>";

//     die;

header("location:../../../view/user/cart.php");
}

/*
Array
(
    [3] => Array
        (
            [quantity] => 1
        )

    [1] => Array
        (
            [quantity] => 1
        )

    [2] => Array
        (
            [quantity] => 3
        )

)
*/