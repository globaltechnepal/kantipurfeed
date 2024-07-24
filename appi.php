<?php
// echo "test appi";

$api_url = 'http://api.globaltech.com.np:802/api/MasterList/ProductList?DbName=ErpDEmo101';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$response_data = json_decode($json_data);

// All user data exists in 'data' object
$user_data = $response_data->data;

// Cut long data into small & select only first 10 records
// $user_data = array_slice($user_data, 0, 9);

// Print data if need to debug
//print_r($user_data);
echo json_encode($user_data);
// Traverse array and display user data
// foreach ($user_data as $user) {
// 	echo "name: ".$user->employee_name;
// 	echo "<br />";
// 	echo "name: ".$user->employee_age;
// 	echo "<br /> <br />";
// }

?>
<?php

        // Include Request and Response classes

        $url = 'https://api.exoclick.com/v2/login';

        $params = array(
                'api_token'  => 'tokenhere'
            );

        // Create a new Request object
        $request = new Request($url, 'POST', $params);

        // Send the request
        $request->send();

        // Get the Response object
        $response = $request->getResponse();

        if($response->getStatusCode() == 200) {

            // Retrieve the session token details
            $token = $response->getBodyDecoded();

            print_r($token);
        }
        else {

            echo $response->getStatusCode() . PHP_EOL;
            echo $response->getReasonPhrase() . PHP_EOL;
            echo $response->getBody() . PHP_EOL;
        }
    ?>