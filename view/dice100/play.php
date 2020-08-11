<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h1>Dice</h1>

<?php if (!$check) : ?>
    <form method="post">
        <input type="submit" name="doDice" value="Roll dice">
        <input type="submit" name="doEnd" value="End turn">
        <input type="submit" name="doRestart" value="Restart">
    </form>

    <p>Your last roll: <b><?= $handVal ?></b></p>
    <p>Your turn score: <b><?= $turnScore ?></b></p>
    <p>Player score: <b><?= $playerScore ?></b></p>
    <p>Computer score: <b><?= $computerScore ?></b></p>
<?php endif ?>

<?php if ($check) : ?>
    <form method="post">
        <input type="submit" name="doRestart" value="Restart">
    </form>
    <p><b><?= $check ?></b></p>
<?php endif ?>

