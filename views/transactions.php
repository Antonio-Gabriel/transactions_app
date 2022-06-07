<!DOCTYPE html>
<html lang="pt-AO">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Transactions</title>

	<style>
		table {
			width: 100%;
			border-collapse: collapse;
			text-align: center;
		}

		table tr th,
		table tr td {
			padding: 5px;
			border: 1px solid #eee;
		}

		tfoot tr th,
		tfoot tr td {
			font-size: 20px;
		}

		tfoot tr th {
			text-align: right;
		}
	</style>
</head>

<body>
	<table>
		<thead>
			<tr>
				<th>Date</th>
				<th>Check #</th>
				<th>Description</th>
				<th>Amount</th>
			</tr>
		</thead>

		<tbody>
			<?php if (!empty($transactions)) : ?>
				<?php foreach ($transactions as $transaction) : ?>
					<tr>
						<td><?= formatDate($transaction["date"]); ?></td>
						<td><?= $transaction["checkNumber"]; ?></td>
						<td><?= $transaction["description"]; ?></td>
						<td>
							<span style="<?= $transaction["amount"] < 0 ? 'color: red;' : 'color: green;' ?>">
								<?= formatDollarAmount($transaction["amount"]); ?>
							</span>
						</td>
					</tr>
				<?php endforeach; ?>

			<?php endif; ?>
		</tbody>

		<tfoot>
			<tr>
				<th colspan="3">Total Income:</th>
				<td><?= formatDollarAmount($totals["totalIncome"] ?? 0); ?></td>
			</tr>

			<tr>
				<th colspan="3">Total Expense:</th>
				<td><?= formatDollarAmount($totals["totalExpense"] ?? 0); ?></td>
			</tr>

			<tr>
				<th colspan="3">Net Total:</th>
				<td><?= formatDollarAmount($totals["netTotal"] ?? 0); ?></td>
			</tr>
		</tfoot>
	</table>
</body>

</html>