<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- VENDOR CSS -->
    <link rel="stylesheet" type="text/css" href="/css/vendor/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/css/vendor/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/vendor/toastify.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <link rel="stylesheet" type="text/css" href="/css/animated-background.css">

    <!-- VENDOR JS -->
    <script type="text/javascript" src="/js/vendor/jquery.js"></script>
    <script type="text/javascript" src="/js/vendor/bootstrap.js"></script>
    <script type="text/javascript" src="/js/vendor/simple-crypto.js"></script>
    <script type="text/javascript" src="/js/vendor/bootbox.js"></script>
    <script type="text/javascript" src="/js/vendor/toastify.js"></script>
    <script type="text/javascript" src="/js/vendor/moment.js"></script>
    <script type="text/javascript" src="/js/vendor/sanitize-html.js"></script>
    <script type="text/javascript" src="/js/vendor/marked.js"></script>

    <!-- MAIN JS -->
    <script type="text/javascript" src="/js/main.js"></script>

    <title>Starless Sky | <?= $title ?></title>
</head>

<body>
    <div id="appWrapper" class="h-100 container">
        <div class="h-100 row justify-content-center">
            <div class="h-100 col-md-<?= $data["card.size"] ?? "6" ?> col-sm-12 d-flex flex-column">
                <div class="my-auto card border-0 shadow rounded-10" id="content">
                    <div class="card-body d-flex flex-column">
                        <img src="/images/starless sky alata.png" style="width: 220px; height: auto;" class="mx-auto mb-3" />
                        <h5 class="text-center mb-4"><?= $data["card.title"] ?></h5>
                        <?php include INPHINIT_PATH . "application/View/" . $view . ".php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>