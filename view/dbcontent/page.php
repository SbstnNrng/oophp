<?php

if (!$resultset) {
    return;
}

$updated = $resultset[0]->created;

if ($resultset[0]->updated) {
    $updated = $resultset[0]->updated;
}
$dbContent = new Seb\dbContent\DbContent();
$textfilter = new Seb\SebTextFilter\SebTextFilter();
$filters = $dbContent->filtersStrToArr($resultset[0]->filter);

?>

<article>
    <header>
        <h1><?= $resultset[0]->title ?></h1>
        <p><i>Latest update: <time datetime="<?= $updated ?>" pubdate><?= $updated ?></time></i></p>
    </header>
    <?= $textfilter->parse($resultset[0]->data, $filters)  ?>
</article>
