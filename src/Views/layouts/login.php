<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?= $this->getMeta(); ?>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/style/reset.css">
    <link rel="stylesheet" href="/assets/style/style.css">
    <!-- <script defer src="/assets/js/header_menu.js"></script> -->
    <title><?= $this->title ?></title>
</head>

<body>
    {{content}}
</body>

</html>