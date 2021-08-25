<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<?php include 'nav.php'; ?>
<br>
<br>
<form method="post">
    <label>Title</label>
    <br>
    <input type="search" name="searchTitle"/>
    <br>
    <input type="submit" name="doTitleSearch" value="Search Title">
</form>
<br>
<form method="post">
    <label>Year 1</label>
    <br>
    <input type="number" name="searchYear1" value="1900" min="1900" max="2020"/>
    <br>
    <label>Year 2</label>
    <br>
    <input type="number" name="searchYear2" value="2020" min="1900" max="2020"/>
    <br>
    <input type="submit" name="doYearSearch" value="Search Year">
</form>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>
