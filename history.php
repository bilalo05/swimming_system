<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Archieve Des Courses</h1>
    <div id="contestsHistory">
        <?php
        include 'db.php';
        
        // Fetch all contests
        $contests = $conn->query("SELECT * FROM contests");
        while ($contest = $contests->fetch_assoc()) {
            echo '<div class="contest">';
            echo '<h3 class="big-title bgt">Course : ' . date('Y-m-d', strtotime($contest['date'])) . ' / ' . $contest['type'] . '</h3>';
            echo '<button class="deleteContest button button2" data-id="'.$contest['id'].'">Supprimer</button>';

            // Fetch results for the current contest
            $contest_id = $contest['id'];
            $results = $conn->query("SELECT swimmers.firstname, swimmers.lastname, results.time_spent 
                                    FROM results 
                                    JOIN swimmers ON results.swimmer_id = swimmers.id 
                                    WHERE results.contest_id = $contest_id 
                                    ORDER BY results.time_spent ASC");
            
            if ($results->num_rows > 0) {
                echo '<table>';
                echo '<thead><tr><th>Nageur</th><th>Temp Passé (seconds)</th></tr></thead>';
                echo '<tbody>';
                while ($result = $results->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $result['firstname'] . ' ' . $result['lastname'] . '</td>';
                    echo '<td>' . $result['time_spent'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p>Aucun résultat pour ce concours.</p>';
            }

            echo '</div>';
        }
        ?>
    </div>

    <script>
    $(document).ready(function() {
        $('.deleteContest').click(function() {
            var contest_id = $(this).data('id');
            if (confirm('Êtes-vous sûr de vouloir supprimer ce course ?')) {
                $.ajax({
                    type: 'POST',
                    url: 'delete_contest.php',
                    data: { id: contest_id },
                    success: function(response) {
                        alert(response);
                        location.reload();  // Reload the page to reflect changes
                    }
                });
            }
        });
    });
    </script>
</body>
</html>
