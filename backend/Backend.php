<?php
//require vendor autoloader
require('./vendor/autoload.php');
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

    public function getDistanceMatrix($origin, $destination)
    {
        // set up API key and URL
        $apiKey = "YOUR_API_KEY";
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial";

        // set up origin and destination coordinates
        $origin = "origin=41.43206,-81.38992";
        $destination = "destination=41.4993,-81.6944";

        // build the full URL with API key and coordinates
        $fullUrl = $url . "&" . $origin . "&" . $destination . "&key=" . $apiKey;

        // make the API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fullUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // decode the JSON response
        $data = json_decode($response, true);

        // print the distance and duration
        echo "Distance: " . $data['rows'][0]['elements'][0]['distance']['text'] . "<br>";
        echo "Duration: " . $data['rows'][0]['elements'][0]['duration']['text'] . "<br>";
    }
}
