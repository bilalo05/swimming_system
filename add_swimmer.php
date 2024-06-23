<?php
include 'db.php';

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['age']) && isset($_POST['club'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $age = intval($_POST['age']);
    $club = $_POST['club'];

    $query = "INSERT INTO swimmers (firstname, lastname, age, club) VALUES ('$firstname', '$lastname', $age, '$club')";
    if ($conn->query($query) === TRUE) {
        echo "Nageur ajouté avec succès ";
    } else {
        echo "Erreur lors de l'ajout du nageur : " . $conn->error;
    }
} else {
    echo "Tous les champs sont requis.";
}
?>
