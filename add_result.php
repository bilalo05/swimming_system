<?php
include 'db.php';

if (isset($_POST['contest_id']) && isset($_POST['swimmers']) && isset($_POST['time'])) {
    $contest_id = intval($_POST['contest_id']);
    $time = floatval($_POST['time']);
    $swimmers = $_POST['swimmers'];

    foreach ($swimmers as $swimmer_id) {
        $swimmer_id = intval($swimmer_id);
        $query = "INSERT INTO results (contest_id, swimmer_id, time_spent) VALUES ($contest_id, $swimmer_id, $time)";
        if (!$conn->query($query)) {
            echo "Error: " . $conn->error;
            exit;
        }
    }
    echo "Results added successfully";
} else {
    echo "Invalid data provided.";
}
?>
