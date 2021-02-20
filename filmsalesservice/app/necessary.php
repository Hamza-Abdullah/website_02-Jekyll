<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL | E_STRICT);
    // LOAD CONFIG
    require_once("config/config.php");

    // LOAD HELPERS
    require_once("helpers/urlHelper.php");
    require_once("helpers/sessionHelper.php");

    // LOAD LIBRARIES
    // require_once("libraries/Core.php");
    // require_once("libraries/Controller.php");
    // require_once("libraries/Database.php");

    // AUTOLOAD CORE LIBRARIES
    spl_autoload_register(function($classNAME) {
        require_once("libraries/" . $classNAME . ".php");
    });

?>