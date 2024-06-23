<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $club = $_POST['club'];

    $sql = "UPDATE swimmers SET firstname='$firstname', lastname='$lastname', age='$age', club='$club' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Swimmer updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
