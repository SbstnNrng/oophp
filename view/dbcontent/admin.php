<?php

namespace Anax\View;

namespace Seb\dbContent;

if (!$resultset) {
    return;
}
?>
<br>
<a href="create" title="Create" class="knapp-create">Create</a>
<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Filter</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Actions</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->filter ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td>
            <a href="edit/<?= $row->id ?>" title="Edit">Edit</a>
            <a href="delete/<?= $row->id ?>" title="Delete">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
