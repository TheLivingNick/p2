<?php
require('helpers.php');

# Create asscociative array of letter values from JSON
$letterValuesJSON = file_get_contents('json/letterValues.json');
$letterValues = json_decode($letterValuesJSON, true);

# if a word was entered, keep it after submit, otherwise default to empty string
if (isset($_GET['userWord'])) {
    $userWord = $_GET['userWord'];
} else {
    $userWord = '';
}

# if the multiplier was changed from noBonus use the value in $_GET, other default to noBonus
if (isset($_GET['bonusMult']) && $_GET['bonusMult'] != 'noBonus') {
    $bonusMult = $_GET['bonusMult'];
} else {
    $bonusMult = 'noBonus';
}

# if the 7-letter bonus box was checked keep the check, otherwise default to blank
if (isset($_GET['sevenBonus'])) {
    $sevenBonus = 'CHECKED';
} else {
    $sevenBonus = '';
}

# check to see if there is an entered word, if the string is all letters, then computes the value of the word
# if there is no entry a default result area is displayed; if there are non-letter characters, a bad result is displayed
if ($userWord != '' && ctype_alpha($userWord)) {
  $wordValue = 0;
  $wordArray = str_split($userWord);

  # loop through each letter and add its value to the total
  foreach($wordArray as $index => $letter) {
    $wordValue += $letterValues[strtolower($letter)];
  }

  # apply multipliers if there are any
  if ($bonusMult == 'doubleScore') {
    $wordValue += $wordValue;
  } elseif ($bonusMult == 'tripleScore') {
    $wordValue = $wordValue * 3;
  } else {
    $wordValue = $wordValue;
  }

  # if the Used All Letters bonus is checked and the word is long enough add the bonus
  if ($sevenBonus == 'CHECKED' && strlen($userWord) >= 7) {
    $wordValue += 50;
  }

  # set result area to haveResult and seed the text for it
  $resultType = 'haveResult';
  $resultText = '';

  # add image of each letter in sequence to show word in tile form
  foreach ($wordArray as $index => $letter) {
    $resultText = $resultText."<img class=\"tilePic\" src=\"images\\letter-".$letter.".png\">";
  }

  # append the total value of the word
  $resultText = $resultText." is worth ".$wordValue." points!";
} elseif ($userWord != '' && !ctype_alpha($userWord)) {
  #if result contains non-letters, show a bad result
  $resultType = 'badResult';
  $resultText = "Your entry can only contain letters.";
} else {
  # if there is no entered word, show a placeholder result
  $resultType = 'noResult';
  $resultText = "This is where your result will display!";
}
