<?php

declare(strict_types=1);

$root = __DIR__ . DIRECTORY_SEPARATOR;

define("APP_PATH", $root . "app" . DIRECTORY_SEPARATOR);
define("VIEWS_PATH", $root . "views" . DIRECTORY_SEPARATOR);
define("HELPERS_PATH", APP_PATH . "helpers" . DIRECTORY_SEPARATOR);
define("FILE_PATH", $root . "transactionFile" . DIRECTORY_SEPARATOR);

/**
 * Modules requires
 */

require APP_PATH . "app.php";
require HELPERS_PATH . "formatDate.php";
require HELPERS_PATH . "prettyPrintArray.php";
require HELPERS_PATH . "formatDollarAmount.php";

$files = getTransactionsFile(FILE_PATH);

$transactions = [];
foreach ($files as $file) {
    $transactions = array_merge(
        $transactions,
        getTransactions($file, "extractTransaction")
    );
}

$totals = calculateTotals($transactions);

// prettyPrintArray(
//     $transactions
// );

/**
 * Transaction view
 */

require VIEWS_PATH . "transactions.php";
