<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://<?= $url ?>">
    <title><?= $pageTitle ?></title>

    <?= $pageHead ?>

    <meta name="description" value="Conținut CMS"/>
    <meta name="keywords" value=""/>

</head>
    <?php if ($bodyClass) : ?><body class="<?= $bodyClass ?>"><?php else: ?><body><?php endif ?>
    <?= $pageContent ?>

    </body>
</html>