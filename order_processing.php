<?php
include 'assets/library/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the JSON data sent from the client
    $json_data = file_get_contents('php://input');

    // Decode the JSON data to PHP array
    $order_details = json_decode($json_data, true);

    // Sanitize input if needed to prevent SQL injection attacks
    // For example: $order_details = sanitize($order_details);

    // Get the API URL from the database
    $getApi_query = "SELECT api_value FROM api WHERE api_name = 'Orders';";
    $conn = connectDB();
    $req = mysqli_query($conn, $getApi_query);
    
    if ($req) {
        $data = mysqli_fetch_assoc($req);
        $order_api_url = $data['api_value'];
        echo "<script>alert('".$order_api_url."');</script>";
        // Call the external API to place the order
        $ch = curl_init($order_api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_details));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $external_api_response = curl_exec($ch);

        if ($external_api_response !== false) {
            // Successful response from the external API
            // You can process or log the response if needed
            // Send a response back to the client
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Order placed successfully via external API'));
        } else {
            // Error in calling the external API
            http_response_code(500);
            echo 'Error calling external API';
        }
        // Close cURL resource
        curl_close($ch);
    } else {
        // Error in retrieving API URL from the database
        http_response_code(500);
        echo 'Error retrieving API URL';
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Handle invalid requests
    http_response_code(405); // Method Not Allowed
    echo 'Invalid request';
}
?>
