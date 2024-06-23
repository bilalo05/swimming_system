<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Swimmer</title>
</head>
<body>
<?php include 'navbar.php'; ?>

    <h2>Add Swimmerd</h2>
    <form action="add_swimmer.php" method="post">
        Firstname: <input type="text" name="firstname"><br>
        Lastname: <input type="text" name="lastname"><br>
        Age: <input type="number" name="age"><br>
        Club: <input type="text" name="club"><br>
        <input type="submit" value="Add Swimmer">
    </form>
</body>
</html>
