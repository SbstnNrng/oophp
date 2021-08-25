<?php

namespace Seb\SebTextFilter;

$filter = new SebTextFilter();

$textbb = file_get_contents(__DIR__ . "/../../src/SebTextFilter/textexamples/bbcode.txt");
$textmd = file_get_contents(__DIR__ . "/../../src/SebTextFilter/textexamples/sample.md");
$textcl = file_get_contents(__DIR__ . "/../../src/SebTextFilter/textexamples/clickable.txt");

$bbcfilter = $filter->parse($textbb, ["bbcode", "nl2br"]);
$mdfilter = $filter->parse($textmd, ["markdown"]);
$linkfilter = $filter->parse($textcl, ["link"]);

?>
<h1>Textfilter</h1>
<p>Här är exempeltexterna som filtreras med olika filter</p>

<h2>Text som är filtrerad för bbcode</h2>
<div><?= $bbcfilter ?></div>

<h2>Text som är filtrerad för markdown</h2>
<div><?= $mdfilter ?></div>

<h2>Text som är filtrerad för länkar</h2>
<div><?= $linkfilter ?></div>