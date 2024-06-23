<?php
include 'db.php';

if (isset($_POST['id'])) {
    $contest_id = intval($_POST['id']);
    $query = "DELETE FROM contests WHERE id = $contest_id";
    if ($conn->query($query) === TRUE) {
        echo "Contest deleted successfully";
    } else {
        echo "Error deleting contest: " . $conn->error;
    }
} else {
    echo "No contest ID provided.";
}
?>
