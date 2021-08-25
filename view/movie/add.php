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
        <input type="text" name="movieTitle"/>
        </label>
    </p>

    <p>
        <label>Year:<br> 
        <input type="number" name="movieYear" value="1900" min="1900"/>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
    </p>
</form>
