<?php
function get_response($code){
    //some Imp responses
    $success = array(
    'message'=>'success',
    'status_code'=>'200',
    'data'=>'array()'
    );
    $failure = array(
    'message'=>'failure',
    'status_code'=>'201',
    'data'=>'array()'
    );
    $errore = array(
    'message'=>'errore',
    'status_code'=>'502',
    'data'=>'array()'
    );
    $response = array(
    'message'=>'unknown',
    'status_code'=>'501',
    'data'=>'array()'
    );
    //some Imp responses
    switch ($code) {
        case '200':
            return $success;
            break;
        case '201':
            return $failure;
            break;
        case '501':
            return $response;
            break;
        case '502':
            return $errore;
            break;
        case '200':
            return $success;
            break;
        default:
            return $response;
            break;
    }
}
?>