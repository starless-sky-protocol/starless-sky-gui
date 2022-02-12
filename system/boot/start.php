<?php
use Inphinit\App;

require_once INPHINIT_PATH . 'vendor/inphinit/framework/src/Utils.php';

if (INPHINIT_COMPOSER) {
    require_once INPHINIT_PATH . 'vendor/autoload.php';
} else {
    UtilsAutoload();
}

UtilsConfig();

require_once INPHINIT_PATH . 'main.php';
require_once INPHINIT_PATH . '/boot/util.php';

App::exec();
