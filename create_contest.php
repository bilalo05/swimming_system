<?php
include 'db.php';

if (isset($_POST['type']) && isset($_POST['positions'])) {
    $type = $_POST['type'];
    $positions = intval($_POST['positions']);
    $query = "INSERT INTO contests (type, positions) VALUES ('$type', $positions)";
    if ($conn->query($query) === TRUE) {
        echo "Contest created successfully";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "All fields are required.";
}
?>
