<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<?php include 'nav.php'; ?>

<form method="post">
    <p>
        <label>Title:<br> 
        <?php foreach ($resultset as $movie) : ?>
            <input type="text" name="movieTitle" value="<?= $movie->title ?>"/>
        <?php endforeach; ?>
        </label>
    </p>

    <p>
        <label>Year:<br> 
        <?php foreach ($resultset as $movie) : ?>
            <input type="number" name="movieYear" value="<?= $movie->year ?>" value="1900" min="1900"/>
        <?php endforeach; ?>
    </p>

    <p>
        <label>Image:<br> 
        <?php foreach ($resultset as $movie) : ?>
            <input type="text" name="movieImage" value="<?= $movie->image ?>"/>
        <?php endforeach; ?>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
    </p>
</form>
