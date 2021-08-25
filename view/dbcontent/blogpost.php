<?php

//namespace Anax\View;

if (!$resultset) {
    return;
}

$dbContent = new Seb\dbContent\DbContent();
$textfilter = new Seb\SebTextFilter\SebTextFilter();
$filters = $dbContent->filtersStrToArr($resultset[0]->filter);

?>

<article>
    <header>
        <h1><?= $resultset[0]->title ?></h1>
        <p><i>Published: <time datetime="<?= $resultset[0]->published ?>" pubdate><?= $resultset[0]->published ?></time></i></p>
    </header>
    <?= $textfilter->parse($resultset[0]->data, $filters) ?>
</article>
