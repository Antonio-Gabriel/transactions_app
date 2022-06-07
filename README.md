# Transactions App

Extracting transactions from the file and calculate the totals (`income`, `expenses` and `net total`).
The main objective is to train the knowledges of new version of php 8.

Transactions file data example:

```csv
Date,   Check #,    Description,    Amount
01/04/2021, 7777,   Transaction 1,  "$150.43"
01/03/2021, ,   Transaction 2,  "$700.25"
01/01/2021, ,   Transaction 3,  "-$1,303.97"
01/06/2021, ,   Transaction 4,  "$46.78"
01/08/2021, ,   Transaction 5,  "$816.87"
01/01/2021, 1934,   Transaction 6,  "-$1,002.53"
```

Get transactions example and extract transactions logic

```php
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

/**
 * Logic for extract transactions 
 *
*/

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
```

Thanks for appreciate my study (AG)