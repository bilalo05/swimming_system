<?php
include 'db.php';

if (isset($_POST['contest_id']) && isset($_POST['positions'])) {
    $contest_id = intval($_POST['contest_id']);
    $positions = intval($_POST['positions']);

    $query = "SELECT swimmers.firstname, swimmers.lastname, results.time_spent 
              FROM results 
              JOIN swimmers ON results.swimmer_id = swimmers.id 
              WHERE results.contest_id = $contest_id";

    $contest_results = $conn->query($query);
    if ($contest_results) {
        $results = [];
        while ($row = $contest_results->fetch_assoc()) {
            $results[] = $row;
        }

        $series_results = [];
        $series = 1;
        foreach (array_chunk($results, $positions) as $chunk) {
            usort($chunk, function($a, $b) {
                return $a['time_spent'] <=> $b['time_spent'];
            });
            $series_results[$series] = $chunk;
            $series++;
        }

        echo '<table>';
        echo '<thead><tr><th>Series</th><th>First Name</th><th>Last Name</th><th>Time Spent (mm:ss:ms)</th></tr></thead>';
        echo '<tbody>';

        foreach ($series_results as $series => $rows) {
            $firstInSeries = true;
            foreach ($rows as $row) {
                echo '<tr>';
                if ($firstInSeries) {
                    echo '<td rowspan="'.count($rows).'">SERIE ' . $series . '</td>';
                    $firstInSeries = false;
                }
                $time_spent = $row['time_spent'];
                $minutes = floor($time_spent / 60);
                $seconds = floor($time_spent % 60);
                $milliseconds = round(($time_spent - floor($time_spent)) * 1000);
                echo '<td>'.$row['firstname'].'</td>';
                echo '<td>'.$row['lastname'].'</td>';
                echo '<td>'.sprintf('%02d:%02d:%03d', $minutes, $seconds, $milliseconds).'</td>';
                echo '</tr>';
            }
        }

        echo '</tbody></table>';
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No contest ID or positions provided.";
}
?>
