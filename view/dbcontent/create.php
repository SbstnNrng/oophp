<?php

namespace Anax\View;

namespace Seb\dbContent;

?>

<form method="post">
    <fieldset>
    <legend>Create</legend>

    <p>
        <label>Title:<br> 
        <input type="text" name="inputTitle" required>
        </label>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="inputData"></textarea>
    </p>

     <p>
        <label>Type:<br>
        <select name="inputType">
            <option value="post">Post</option>
            <option value="page">Page</option>
        </select>
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
        <button type="submit" name="doCreate">Create</button>
    </p>
    </fieldset>
</form>
