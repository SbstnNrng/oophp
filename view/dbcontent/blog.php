<?php

namespace Anax\View;

namespace Seb\dbContent;

if (!$resultset) {
    return;
}
?>

<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="blogpost/<?= $row->slug ?>"><?= $row->title ?></a></h1>
        <p><i>Published: <time datetime="<?= $row->published_iso8601 ?>" pubdate><?= $row->published ?></time></i></p>
    </header>
    <?= $row->data ?>
</section>
<?php endforeach; ?>

</article>
