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
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">

    <!-- VENDOR JS -->
    <script type="text/javascript" src="/js/vendor/jquery.js"></script>
    <script type="text/javascript" src="/js/vendor/bootstrap.js"></script>
    <script type="text/javascript" src="/js/vendor/simple-crypto.js"></script>
    <script type="text/javascript" src="/js/vendor/bootbox.js"></script>
    <script type="text/javascript" src="/js/vendor/toastify.js"></script>
    <script type="text/javascript" src="/js/vendor/moment.js"></script>
    <script type="text/javascript" src="/js/vendor/sanitize-html.js"></script>
    <script type="text/javascript" src="/js/vendor/marked.js"></script>
    <script type="text/javascript" src="/js/vendor/noble-hashes.js"></script>
    <script type="text/javascript" type="module" src="/js/vendor/noble-hashes-wrapper.js"></script>

    <!-- MAIN JS -->
    <script type=" text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/dashboard.js"></script>
    <script type="text/javascript" src="/js/node-validator.js"></script>

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
                    <li class="s-nav-card">
                        <div class="alert alert-primary">
                            <h5 id="card_name" class="text-ellipsis">Your name</h5>
                            <a href="#" onclick="copyToClipboardRaw('card_address', 'Address copied to the clipboard')">
                                <p id="card_address" class="mb-0 d-inline-block text-ellipsis w-75">0x51251...abc</p>
                                <i class="las la-copy"></i>
                            </a>
                        </div>
                    </li>
                    <li class="s-nav-separator">
                        <hr />
                        <span>Messages</span>
                    </li>
                    <a href="/dashboard/new">
                        <li class="s-nav-link <?= $data["selected-tab"] == "new-message" ? 'active' : '' ?>">
                            <i class="las la-feather-alt"></i> Compose
                        </li>
                    </a>
                    <a href="/dashboard">
                        <li class="s-nav-link <?= $data["selected-tab"] == "messages" ? 'active' : '' ?>">
                            <i class="las la-envelope"></i> Inbox
                        </li>
                    </a>
                    <li class="s-nav-separator">
                        <hr />
                        <span>Contracts</span>
                    </li>
                    <li class="s-nav-link text-muted <?= $data["selected-tab"] == "contracts" ? 'active' : '' ?>">
                        <i class="las la-file-alt"></i> Contracts <small class="text-primary">SOON</small>
                    </li>
                    <li class="s-nav-separator">
                        <hr />
                        <span>Account</span>
                    </li>
                    <li class="s-nav-link text-muted <?= $data["selected-tab"] == "contacts" ? 'active' : '' ?>">
                        <i class="las la-address-book"></i> Address book <small class="text-primary">SOON</small>
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