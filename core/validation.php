
<?php


function vildatename($name) : ?string{
    $error=null;
    if(empty($name)){
        $error="name is required";
    }elseif(! is_string(($name) )){
        $error="name must be string";

    }elseif(strlen($name) > 255){
        $error ="name must not exceed 255";
    }

    return $error;
}
function vildatemail($email){
    $error=null;
    if(empty($email)){
        $error="email is required";
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL) == false){
        $error="EMAIL NOT VAILD";

    }elseif(strlen($email) > 255){
        $error ="EMAIL must not exceed 255";
    }

    return $error;
}
function vildatage($age){
    $error=null;

    if(is_numeric($age)){
        $age = (int)$age;
    }
    if(!empty($age)){
        if(! is_int($age)){
            $error="age must be int";
        }elseif($age <= 0){
            $error="error must > 0";
        }
    }

    return $error;
}
function vildateprice($price){
    $error=null;

    if(is_numeric($price)){
        $price = (int)$price;
    }
    if(!empty($price)){
        if(! is_int($price)){
            $error="price must be int";
        }elseif($price <= 0){
            $error="price must > 0";
        }
    }

    return $error;
}

function vildatepassword($password,$confirmpassword){
    $error=null;
    if(empty($password)){
        $error="password is required";
    }elseif(! is_string(($password))){
        $error="password must be string";

    }elseif(strlen($password) < 3  ){
        $error ="password must be between 3 && 30";
    }elseif($password != $confirmpassword){
        $error ="password is wrong";
    }



    return $error;
}
function vildateloginpassword($password){
    $error=null;
    if(empty($password)){
        $error="password is required";
    }elseif(! is_string(($password))){
        $error="password must be string";

    }elseif(strlen($password)< 3  ){
        $error ="password must be between 3 && 30";
    }



    return $error;
}

function validateimage(array $image){

    $error=null;
    $toarr=explode("/",$image['type']);
    $index=$toarr[0];

    if($image['error']  != 0){
        $error="image is required";
    }elseif($index != 'image'){
        $error="type must be image";
    }elseif($image['size'] / (1024 * 1024) >1){//transfer to mb
        $error ="image size must <1mb 1";
    }

    return $error;
}



