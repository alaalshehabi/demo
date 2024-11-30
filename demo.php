https://github.com/alaalshehabi/demo.
//jh
<?php
// Task 1: Data Retrieval

// Define the API endpoint URL to fetch student data
$url = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

// Use file_get_contents to fetch data from the API
$response = file_get_contents($url);

// Check if the response is false, indicating an error in fetching data
if ($response === false) {
    die('Error fetching data from API');
}

// Decode the JSON response into a PHP associative array for easier data manipulation
$result = json_decode($response, true);

// Check if JSON decoding failed; if so, stop the script and show an error
if ($result === null) {
    die('Error decoding JSON');
}
?>

<!-- Task 2: Data Visualization -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Statistics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pico-css@latest/css/pico.min.css">
    <style>
        /* Basic styling for the body */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        /* Styling for the main heading */
        h1 {
            text-align: center;
            font-size: 2.5em;
            margin: 30px 0;
            background-color: #D3D3D3;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        /* Table styling */
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        /* Styling for table headers and cells */
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        /* Alternate row coloring for better readability */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        /* Hover effect for table rows */
        tr:hover {
            background-color: #f1f1f1;
            cursor: pointer;
        }
        /* Class to manage overflow in the table container */
        .overflow-auto {
            max-height: 279px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1> Statistics of Students Enrolled in Bachelor Programs </h1> 
    <div class="overflow-auto"> <!-- Container for the table with overflow handling -->
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>The Programs</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each record in the results array to display the data
                foreach ($result['results'] as $record) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($record['year']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['semester']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['the_programs']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['nationality']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['colleges']) . '</td>';
                    echo '<td>' . htmlspecialchars($record['number_of_students']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html> 
