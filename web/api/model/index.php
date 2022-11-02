<?php
    header("Access-Control-Allow-Origin: *");

    session_start();
    // make a database connection
    $conn = new PDO("pgsql:host=postgis;port=5432;dbname=opendata;", "postgres", "postgres", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    

    if ($conn) {        
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            if(!isset($_GET['make'])){
                die("Bad request");
            }
            if(isset($_GET['year'])){
                $sql = "SELECT * FROM fcr_clean WHERE make = :make AND year = :year";
                $query = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);           
                $query->execute(['make' => $_GET['make'], 'year' => $_GET['year']]);
            } else {
                $sql = "SELECT * FROM fcr_clean WHERE make = :make";
                $query = $conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            
                $query->execute(['make' => $_GET['make']]);

            }

            $results = $query->fetchAll();
            $returnObjects  = array();
            $returnObject = new stdClass();

            foreach($results as $result){
                $returnObject = new stdClass();
                $returnObject->make = $result['make'] ;
                $returnObject->year = $result['year'] ;
                $returnObject->model = $result['model'] ;

                $returnObject->fuelType = $result['fuel_type'] ;
                $returnObject->fuelConsumptionCity = $result['fuel_consumption_city'] ;
                $returnObject->fuelConsumptionHwy = $result['fuel_consumption_hwy'] ;
                $returnObject->fuelConsumptionComb = $result['fuel_consumption_comb'] ;
                $returnObject->co2GramsPerKm = $result['co2_g_per_km'] ;

                $returnObjects[] = $returnObject;

            }
            header('Content-type: application/json');
            die(json_encode($returnObjects));
        }
    }
?>