<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://<?= $url ?>">
    <title><?= $pageTitle ?></title>

    <?= $pageHeader ?>

    <meta name="description" value=<?= json_encode($this->getPageModel()->getMetaDescription()) ?>/>
    <meta name="keywords" value=<?= json_encode($this->getPageModel()->getMetaKeywords()) ?>/>

</head>
    <body>
        <?= $pageContent ?>
    </body>
</html>