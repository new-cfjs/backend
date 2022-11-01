<?php

    session_start();
    // make a database connection
    $conn = new PDO("pgsql:host=postgis;port=5432;dbname=opendata;", "postgres", "postgres", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    

    if ($conn) {        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){


            $data = [
                'session_id' => '123',
                'email' => $_POST['email'],
                'startLon' => $_POST['startLongitude'],
                'startLat' => $_POST['startLatitude'],
                'destLon' => $_POST['destinationLongitude'],
                'destLat' => $_POST['destinationLatitude'],
                'marque_vehicule' => $_POST['make'],
                'modele_vehicule' => $_POST['model'],
                'annee_vehicule' => $_POST['year'],
                'temps_auto' => $_POST['timeCar'],
                'temps_transport_commun' => $_POST['timePublicTransit'],
                'temps_velo' => $_POST['timeBike'],
                'temps_marche' => $_POST['timeWalking'],
                'distance_auto' => $_POST['distanceCar'],
                'distance_transport_commun' => $_POST['distancePublicTransit'],
                'distance_velo' => $_POST['distanceBike'],
                'distance_marche' => $_POST['distanceWalking']

            ];

            $sql = "INSERT INTO mes_ges(session_id, email, point_depart, point_arrivee,  marque_vehicule,
            modele_vehicule, annee_vehicule, temps_auto, temps_transport_commun,
            temps_velo, temps_marche, distance_auto, distance_transport_commun,
            distance_velo, distance_marche)
            VALUES(:session_id, :email, 
            ST_SetSRID(ST_Point(:startLon, :startLat),4326), 
            ST_SetSRID(ST_Point(:destLon, :destLat),4326), 
            :marque_vehicule,
            :modele_vehicule, :annee_vehicule, :temps_auto, :temps_transport_commun,
            :temps_velo, :temps_marche, :distance_auto, :distance_transport_commun,
            :distance_velo, :distance_marche )";
            $query= $conn->prepare($sql);
            $query->execute($data);

        } else {
            die('Bad Request');
        }
    } else {
        die('conn failed');
    }
?>