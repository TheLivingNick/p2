<?php
require('helpers.php');

# Create asscociative array of letter values from JSON
$letterValuesJSON = file_get_contents('json/letterValues.json');
$letterValues = json_decode($letterValuesJSON, true);
$bonusMult = 'noBonus';
$allLettersBonus = '';

# Retrieve data from the form
if (isset($_GET['userWord'])) {
    $userWord = $_GET['userWord'];
} else {
    $userWord = '';
}
