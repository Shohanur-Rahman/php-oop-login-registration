<?php

namespace App\functions;

function escape($string){
    return htmlentities($string,ENT_QUOTES,'UTF-8');
}

function testFunction(){
    echo "Hello wOrld";
}