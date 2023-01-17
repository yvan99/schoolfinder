<?php

class Backend
{

    public function connectDb()
    {
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'finder');

        try {
            return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            exit("error:" . $e->getMessage());
        }
    }

    public function getSchools($clientAddress, $schoolType, $schoolCategory)
    {
        $connectBackend = new Backend;
        $connectDb = $connectBackend->connectDb();
        $sql = "SELECT * FROM schools WHERE school_shotype='$schoolType' AND school_category='$schoolCategory'";
        $stmt = $connectDb->prepare($sql);
        $stmt->execute();
        $fetchSchools = $stmt->fetchAll();
        $responseJson = json_encode($fetchSchools);
        $original_data = json_decode($responseJson, true);
        $features = array();
        foreach ($original_data as $key => $value) {
            $features[] = array(
                'type' => 'Feature',
                'properties' => array('Name' => $value['school_name'], 'garageId' => $value['school_id'], 'Address' => $value['school_address'], 'Status' => 'Operational'),
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        $value['school_lon'],
                        $value['school_lat'],
                        1
                    ),
                ),
            );
        }
        $final_data = json_encode($features);
        session_start();
        $_SESSION["schools"] = $final_data;
        header('location:../find.php');
    }
}
