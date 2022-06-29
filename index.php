<!DOCTYPE html>
<html lang="nl">
<head>
    <meta property="og:title" content="Philomena" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philomena</title>
    <!-- favicon -->
    <link rel="icon" href="images/philomena-favicon.png" sizes="any" type="image/svg+xml">
    <!-- js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script/main.js"></script>
    <script defer src="script/appointments.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/404.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- font awesome icons -->
    <script src="https://kit.fontawesome.com/f5d016d888.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once("header.php") ?>
    <div class="overlay"></div>
    <div class="content philomena-import">
        <div class="section-wrapper">
            <div class="big-banner"></div>
            <div class="image-row">
                <div class="image-left"></div>
                <div class="image-right"></div>
            </div>
            <div class="section-title">Producten</div>
            <div class="image-row">
                <div class="image-center"></div>
            </div>
        </div>
    </div>
    <?php //require_once("footer.php") ?>
</body>
</html>