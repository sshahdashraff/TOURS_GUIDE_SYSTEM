<?php
// Read the JSON data from the file
$data = file_get_contents('database.json');

// Decode the JSON data into a PHP array
$trips = json_decode($data, true)['trips'];

// Check if the user has submitted a search query
if (isset($_GET['q'])) {
  // Get the search query from the URL parameter
  $query = $_GET['q'];

  // Filter the trips array to only include trips that match the search query
  $results = array_filter($trips, function($trip) use ($query) {
    return stripos($trip['name'], $query) !== false;
  });
} else {
  // If no search query has been submitted, return all trips
  $results = $trips;
}
?>