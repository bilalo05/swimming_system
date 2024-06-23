<?php
include 'db.php';

$result = $conn->query("SELECT * FROM swimmers");
while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['firstname'].'</td>';
    echo '<td>'.$row['lastname'].'</td>';
    echo '<td>'.$row['age'].'</td>';
    echo '<td>'.$row['club'].'</td>';
    echo '<td><button class="deleteSwimmer button button2" data-id="'.$row['id'].'">Supprimer</button></td>';
    echo '</tr>';
}
?>
