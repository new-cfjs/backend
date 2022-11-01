<?php

    session_start();
    //echo(phpinfo());
    // make a database connection
    $conn = new PDO("pgsql:host=postgis;port=5432;dbname=opendata;", "postgres", "postgres", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    
    if ($conn) {        
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $query = $conn->query("SELECT distinct(make) FROM fcr_clean;", PDO::FETCH_ASSOC);
            $results = $query->fetchAll();
            $returnObject  = array();

            foreach($results as $result){
                $returnObject[] = $result['make'] ;         
            }
            header('Content-type: application/json');
            die(json_encode($returnObject));
        }
    }
?>