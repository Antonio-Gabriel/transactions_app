<?php

declare(strict_types=1);

$root = __DIR__ . DIRECTORY_SEPARATOR;

define("APP_PATH", $root . "app" . DIRECTORY_SEPARATOR);
define("VIEWS_PATH", $root . "views" . DIRECTORY_SEPARATOR);
define("FILE_PATH", $root . "transactionFile" . DIRECTORY_SEPARATOR);

/**
 * Modules requires
 */

require APP_PATH . "app.php";

$files = getTransactionsFile(FILE_PATH);
var_dump($files);
