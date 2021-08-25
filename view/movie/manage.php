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
        <select name="movieId">
            <option value="">Select movie</option>
            <?php foreach ($resultset as $row) : ?>
            <option value="<?= $row->id ?>"><?= $row->title ?></option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
</form>
