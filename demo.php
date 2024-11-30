
<?php
// First Step: Implement Data Retrieval

// Specify the API endpoint to obtain student information
$apiEndpoint = 'https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100';

// Fetching data from the API using file_get_contents
$apiResponse = file_get_contents($apiEndpoint);

// If the response fails, display an error message and halt execution
if ($apiResponse === false) {
    exit('Failed to retrieve data from the API.');
}

// Convert the API's JSON response into an associative PHP array
$dataArray = json_decode($apiResponse, false);

// Stopping the execution + show an error if JSON parsing fails
if ($dataArray === null) {
    exit('Error in JSON decoding.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Statistics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pico-css@latest/css/pico.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #444;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            font-size: 2.2em;
            margin: 20px;
            background-color: #e0e0e0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 1px 3px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e6e6e6;
            cursor: pointer;
        }

        .overflow-container {
            max-height: 280px;
            overflow-y: auto;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>UOB Student Enrollment Data</h1>
    <div class="overflow-container">
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Student Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Iterate through the retrieved data and display it in the table
                foreach ($dataArray['results'] as $student) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($student['year']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['semester']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['the_programs']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['nationality']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['colleges']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['number_of_students']) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
