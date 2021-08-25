<?php

namespace Anax\View;

namespace Seb\dbContent;

if (!$resultset) {
    return;
}

?>

<form method="post">
    <fieldset>
    <legend>Edit</legend>

    <p>
        <label>Title:<br> 
        <input type="text" name="inputTitle" value="<?= $resultset[0]->title ?>" required>
        <input type="text" name="oldTitle" value="<?= $resultset[0]->title ?>" required hidden>
        <input type="text" name="inputSlug" value="<?= $resultset[0]->slug ?>" hidden>
        <input type="text" name="inputPath" value="<?= $resultset[0]->path ?>" hidden>
        <input type="text" name="inputType" value="<?= $resultset[0]->type ?>" hidden>
        </label>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="inputData"><?= $resultset[0]->data ?></textarea>
    </p>

     <p>
         <label>Filter:</label><br>
         <input type="checkbox" name="bbcode" value="bbcode">
         <label for="bbcode">bbcode</label><br>
         <input type="checkbox" name="link" value="link">
         <label for="link">Link</label><br>
         <input type="checkbox" name="markdown" value="markdown">
         <label for="markdown">Markdown</label><br>
         <input type="checkbox" name="nl2br" value="nl2br">
         <label for="nl2br">nl2br</label><br>
    </p>
    
    <p>
        <button type="submit" name="doEdit">Edit</button>
    </p>
    </fieldset>
</form>
