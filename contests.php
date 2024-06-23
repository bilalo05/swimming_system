<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contests</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<h2>Course</h2>
<form id="createContestForm" action="add_contest.php" method="post">
    Type du course: 
    <select name="type">
        <option value="50 meters">50 metres</option>
        <option value="100 meters">100 metres</option>
    </select><br>
    Positions: <input type="number" name="positions" id="positions" required><br>

    <input type="submit" value="Créer un Course">
</form>

<div id="contestSection" style="display:none;">
    <h3>Nageurs</h3>
    <form id="swimmersForm">
        <input type="hidden" name="contest_id" id="contest_id">
        <label for="swimmers">Selectionner un nageur:</label>
        <select id="swimmers" name="swimmers[]" multiple="multiple" style="width: 300px;">
            <?php
            include 'db.php';
            $result = $conn->query("SELECT * FROM swimmers");
            while ($row = $result->fetch_assoc()) {
                echo '<option value="'.$row['id'].'">'.$row['firstname'].' '.$row['lastname'].'</option>';
            }
            ?>
        </select><br>
        <label for="minutes">Minutes:</label>
        <input type="number" name="minutes" id="minutes" min="0" value="0"><br>
        <label for="seconds">Seconds:</label>
        <input type="number" name="seconds" id="seconds" min="0" max="59" value="0"><br>
        <label for="milliseconds">Milliseconds:</label>
        <input type="number" name="milliseconds" id="milliseconds" min="0" max="999" value="0"><br>
        <input type="submit" value="Ajouter une Resultats">
    </form>

    <h3>Resultats</h3>
    <div id="results">
        <!-- Results will be displayed here -->
    </div>
    <div id="resultsList"></div>
</div>

<script>
$(document).ready(function() {
    $('#swimmers').select2();

    // Handle form submission for creating a new contest
    $('#createContestForm').submit(function(event) {
        var positions = $('#positions').val();
        localStorage.setItem('positions', positions);
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'add_contest.php',
            data: $(this).serialize(),
            success: function(response) {
                alert('Contest created successfully');
                $('#contest_id').val(response);  // Assuming the response returns the contest ID
                $('#contestSection').show();
                $('#swimmersForm')[0].reset();  // Reset the form inputs
                $('#results').empty();  // Clear the results section
                $('#swimmers').val(null).trigger('change');  // Reset the select2 dropdown
                loadResults(response, positions);  // Pass contest ID and positions to loadResults
            }
        });
    });

    // Handle form submission for adding results
    $('#swimmersForm').submit(function(event) {
        event.preventDefault();
        var contest_id = $('#contest_id').val();
        var swimmers = $('#swimmers').val();
        var minutes = $('#minutes').val();
        var seconds = $('#seconds').val();
        var milliseconds = $('#milliseconds').val();

        var time = (parseInt(minutes) * 60) + parseInt(seconds) + (parseInt(milliseconds) / 1000);

        var data = {
            contest_id: contest_id,
            swimmers: swimmers,
            time: time
        };

        $.ajax({
            type: 'POST',
            url: 'add_result.php',
            data: data,
            success: function(response) {
                alert(response);
                var positions = localStorage.getItem('positions');
                loadResults(contest_id, positions);
            }
        });
    });

    // Load results function
    function loadResults(contest_id, positions) {
        $.ajax({
            type: 'POST',  // Change method to POST
            url: 'get_results.php',
            data: { contest_id: contest_id, positions: positions },
            success: function(data) {
                $('#results').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error fetching results:', textStatus, errorThrown);
            }
        });
    }

    // Hide the contest section initially
    $('#contestSection').hide();
});
</script>

</body>
</html>
