<?php

    session_start();

      
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $ft = new stdClass();
        $ft->X = "Régulier";
        $ft->Z = "Super";
        $ft->D = "Diesel";
        $ft->E = "Éthanol";
        $ft->N = "Gaz Naturel";
        header('Content-type: application/json');
        die(json_encode($ft));
    }

?>
