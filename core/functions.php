<?php 


function checkerrors(array $errors) :bool{
    foreach($errors as $key => $value){
        if($value !== null){
            return false;
        }
    }
    return true;
}