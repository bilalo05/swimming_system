<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swimmers</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include 'loading.html'; ?>
    <h2>Naguers</h2>
    <form id="addSwimmerForm">
        Nom: <input type="text" name="firstname" required><br>
        Prénom: <input type="text" name="lastname" required><br>
        Age: <input type="number" name="age" required><br>
        Club: <input type="text" name="club" required><br>
        <input type="submit" value="Ajouter un Nageur">
    </form>

    <h3 class="big-title">List des Nageurs</h3>
    <table id="swimmersTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Club</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Swimmers will be loaded here dynamically -->
        </tbody>
    </table>
    <script src="scripts/script.js"></script>
    <script>
    $(document).ready(function() {
        loadSwimmers();

        $('#addSwimmerForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'add_swimmer.php',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response);
                    loadSwimmers();
                    $('#addSwimmerForm')[0].reset(); // Reset the form
                }
            });
        });

        function loadSwimmers() {
            $.ajax({
                url: 'get_swimmers.php',
                success: function(data) {
                    $('#swimmersTable tbody').html(data);
                }
            });
        }

        // Handle deletion of swimmers
        $(document).on('click', '.deleteSwimmer', function() {
            var swimmer_id = $(this).data('id');
            if (confirm('Are you sure you want to delete this swimmer?')) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_swimmer.php',
                    data: { id: swimmer_id },
                    success: function(response) {
                        alert(response);
                        loadSwimmers();
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
