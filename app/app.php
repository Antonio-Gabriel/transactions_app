<?php

declare(strict_types=1);

// Bussiness rule

function getTransactionsFile(string $dirPath): array
{
    $files = [];

    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue;
        }

        $files[] = $dirPath . $file;
    }

    return $files;
}

function getTransactions(string $filePath, ?callable $transactionHandler = null): array
{
    if (!file_exists($filePath)) {
        trigger_error("File " . $filePath . "does not exists", E_USER_ERROR);
    }

    $file = fopen($filePath, "r");

    fgetcsv($file);

    $transactions = [];

    while (
        ($transaction = fgetcsv($file)) !== false
    ) {
        if ($transactionHandler !== null) {
            $transaction = $transactionHandler($transaction);
        }

        $transactions[] = $transaction;
    }

    return $transactions;
}

function extractTransaction(array $transactionRow): array
{
    /**
     * Bussiness logic for transactions rows
     */

    [
        $date,
        $checkNumber,
        $description,
        $amount
    ] = $transactionRow;

    $amount = (float) str_replace(["$", ","], "", $amount);

    return [
        "date" => $date,
        "checkNumber" => $checkNumber,
        "description" => $description,
        "amount" => $amount
    ];
}

function calculateTotals(array $transactions): array
{
    $totals = ["netTotal" => 0, "totalIncome" => 0, "totalExpenses" => 0];

    foreach ($transactions as $transaction) {
        $totals["netTotal"] += $transaction["amount"];

        if ($transaction["amount"] >= 0) {
            $totals["totalIncome"] += $transaction["amount"];
        } else {
            $totals["totalExpense"] += $transaction["amount"];
        }
    }

    return $totals;
}
