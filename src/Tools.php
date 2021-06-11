<?php

namespace Dsprog;

class Tools
{
    public function convertArraytoJson($array = []){
        header('Content-Type: application/json');
        echo json_encode($array);
        exit;
    }
}