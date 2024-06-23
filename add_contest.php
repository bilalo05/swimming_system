<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];

    $sql = "INSERT INTO contests (type) VALUES ('$type')";

    if ($conn->query($sql) === TRUE) {
        echo $conn->insert_id; // Return the ID of the newly created contest
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
