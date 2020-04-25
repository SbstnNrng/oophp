<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $game->tries() ?> left.</p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is  <b><?= $game->number(); ?></b></p>
<?php endif ?>

<!-- <?= var_export($_POST, true) ?>
<br>
<br>
<?= var_export($_SESSION, true) ?> -->