<?php
function dbConnecting()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'kantipurfeed';
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        echo "Unable to connect to the database";
        die();
    } else {
        return $conn;
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $userEmail = $_POST['userEmail'];

    $sql = "UPDATE checkouts ch
            INNER JOIN cart ON ch.cart_id = cart.id
            INNER JOIN productvariant pv ON ch.product_v_id = pv.id
            INNER JOIN products p ON pv.product_id = p.id
            INNER JOIN colors c ON pv.color_id = c.id
            INNER JOIN delivery_payment_details dpd ON dpd.id = ch.dpd_id
            INNER JOIN users u ON u.id = cart.user_id 
            SET ch.display = 0
            WHERE u.email = ? 
            AND (dpd.delivery_status = 'pending' OR dpd.delivery_status = 'processing') 
            AND ch.id = ?";

    $conn = dbConnecting();
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("si", $userEmail, $id); // "si" indicates one string and one integer

    if ($stmt->execute()) {
        echo "Order canceled successfully.";
    } else {
        echo "Error canceling order: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID value not provided or invalid.";
}
?>
