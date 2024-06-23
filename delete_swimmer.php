
<?php
include 'db.php';

if (isset($_POST['id'])) {
    $swimmer_id = intval($_POST['id']);
    $query = "DELETE FROM swimmers WHERE id = $swimmer_id";
    if ($conn->query($query) === TRUE) {
        echo "Nageur supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression du nageur :" . $conn->error;
    }
} else {
    echo "Aucune pièce d'identité de nageur fournie. le nageur n'exite pas ! ";
}
?>
