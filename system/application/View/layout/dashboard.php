<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="/css/main.css" class="rel">
    <link rel="stylesheet" href="/css/dashboard.css" class="rel">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/simple-crypto-js@2.5.0/dist/SimpleCrypto.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sanitize-html/1.27.5/sanitize-html.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <script src="/js/main.js"></script>
    <script src="/js/dashboard.js"></script>

    <title>Starless Sky | <?= $title ?></title>
</head>

<body>
    <div id="appWrapper" class="<?= $data["max-vh"] ?? false ? 'fit-to-screen' : 'h-100' ?>">
        <div class="row no-gutters">
            <div id="sidebar" class="col-md-2 col-sm-12 <?= isMobile() ? 'py-3' : 'pt-5 pb-3' ?> px-3">
                <button class="collapse-btn" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-expanded="false" aria-controls="sidebarCollapse">
                    <i class="las la-bars la-2x"></i> <span class="ml-3"><?= $title ?></span>
                </button>
                <ul id="sidebarCollapse" class="s-nav-link-wrapper collapse <?= isMobile() ? 'mt-3' : 'show' ?>">
                    <a href="/dashboard">
                        <li class="s-nav-link <?= $data["selected-tab"] == "messages" ? 'active' : '' ?>">
                            <i class="las la-envelope"></i> Inbox
                        </li>
                    </a>
                    <li class="s-nav-link <?= $data["selected-tab"] == "contacts" ? 'active' : '' ?>">
                        <i class="las la-address-book"></i> Contacts
                    </li>
                    <li class="s-nav-link <?= $data["selected-tab"] == "contracts" ? 'active' : '' ?>">
                        <i class="las la-file-alt"></i> Contracts
                    </li>
                    <li class="s-nav-separator">
                        <hr />
                        <span>Settings</span>
                    </li>
                    <a href="/dashboard/settings/public-info">
                        <li class="s-nav-link <?= $data["selected-tab"] == "settings.public-info" ? 'active' : '' ?>">
                            <i class="las la-address-card"></i> Public info
                        </li>
                    </a>
                    <a href="/dashboard/settings/keys">
                        <li class="s-nav-link <?= $data["selected-tab"] == "settings.keys" ? 'active' : '' ?>">
                            <i class="las la-key"></i> Keys
                        </li>
                    </a>
                    <a class="mt-auto" href="#" onclick="lock()">
                        <li class="s-nav-link">
                            <i class="las la-lock"></i> Lock
                        </li>
                    </a>
                </ul>
            </div>
            <div class="col-md-10 col-sm-12">
                <div id="appContent" class="container-fluid <?= $data["full-screen"] ?? false ? '' : 'lock-to-height' ?>">
                    <?php if ($data["show-header"] ?? true && !isMobile()) : ?>
                        <h3 class="<?= isMobile() ? '' : 'mt-5' ?> border-bottom pb-3 mb-3" style="font-weight: 300"><?= $title ?></h3>
                    <?php endif; ?>
                    <?php include INPHINIT_PATH . "application/View/" . $view . ".php"; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>