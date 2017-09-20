<?php require('scrabbleLogic.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <title>DWA15 Project 2</title>
  <!-- <link rel="stylesheet" href="css/dwa15-p1.css"> -->
</head>

<body>

  <p>test index</p>

  <form method="get">

    <input type='text' name='userWord' id='userWord' value='<?=sanitize($userWord)?>'>

    <input type='radio' name='bonusMult' value='noBonus' <?php if ($bonusMult == "noBonus") echo 'CHECKED ' ?>>
    <input type='radio' name='bonusMult' value='doubleScore' <?php if ($bonusMult == "doubleScore") echo 'CHECKED ' ?>>
    <input type='radio' name='bonusMult' value='tripleeScore' <?php if ($bonusMult == "tripleScore") echo 'CHECKED ' ?>>

    <input type='checkbox' name='allLetters' id='allLetters' <?=$allLettersBonus?>>

</body>

</html>
