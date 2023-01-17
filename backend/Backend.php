<?php
//require vendor autoloader
require('../vendor/autoload.php');

use GuzzleHttp\Client; // guzzle helps to make api request
class Backend
{
    public function connectDb()
    {
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', getenv("DATABASE_NAME"));

        try {
            return new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            exit("error:" . $e->getMessage());
        }
    }

    public function getSchools($clientAddress, $schoolType, $schoolCategory)
    {
        $connectDb = self::connectDb();
        $sql = "SELECT * FROM schools WHERE school_shotype='$schoolType' AND school_category='$schoolCategory'";
        $stmt = $connectDb->prepare($sql);
        $stmt->execute();
        $fetchSchools = $stmt->fetchAll();
        $responseJson = json_encode($fetchSchools);
        $original_data = json_decode($responseJson, true);
        $features = array();
        foreach ($original_data as $key => $value) {

            // use distance matrix api to get nearest locations
            $callDistanceMatrix = self::getDistanceMatrix($clientAddress, $value['school_address']);
            if ($callDistanceMatrix <= getenv("NEAREST_PLACE_RATIO") ) {
            $features[] = array(
                'type' => 'Feature',
                'properties' => array('Name' => $value['school_name'], 'schoolId' => $value['school_id'], 'Address' => $value['school_address'], 'Status' => 'Operational'),
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
           }
        $final_data = json_encode($features);
        session_start();
        $_SESSION["schools"] = $final_data;
        header('location:../find.php');
    }

    public function getDistanceMatrix($origin, $destination)
    {
        // set up API key and URL
        $apiKey = getenv("GOOGLE_PLACES_API");

        // set up origin and destination coordinates
        $origin = "origins=" . $origin; // long,lat
        $destination = "destinations=" . $destination;

        // build the full URL with API key and coordinates
        $client = new Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json', [
            'query' => [
                'origins' => $origin,
                'destinations' => $destination,
                'key' => $apiKey
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        return substr($data['rows'][0]['elements'][0]['distance']['text'], 0, -2);
    }
}
