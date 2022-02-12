<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/main.css" class="rel">
    <link rel="stylesheet" href="/css/login.css" class="rel">
    <link rel="stylesheet" href="/css/animated-background.css" class="rel">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/simple-crypto-js@2.5.0/dist/SimpleCrypto.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script src="/js/main.js"></script>

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