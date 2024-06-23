<?php
include 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM swimmers WHERE id=$id");
$swimmer = $result->fetch_assoc();
?>
<form action="update_swimmer.php" method="post">
    <input type="hidden" name="id" value="<?php echo $swimmer['id']; ?>">
    Firstname: <input type="text" name="firstname" value="<?php echo $swimmer['firstname']; ?>"><br>
    Lastname: <input type="text" name="lastname" value="<?php echo $swimmer['lastname']; ?>"><br>
    Age: <input type="number" name="age" value="<?php echo $swimmer['age']; ?>"><br>
    Club: <input type="text" name="club" value="<?php echo $swimmer['club']; ?>"><br>
    <input type="submit" value="Update Swimmer">
</form>
