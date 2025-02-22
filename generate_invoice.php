<?php
include('connection.php'); // Ensure this file correctly connects to your database

// Get the billing ID from the URL
$billing_id = $_GET['billing_id'] ?? 0;

// Fetch billing details
$billing_query = "SELECT * FROM billing WHERE id = $billing_id";
$billing_result = $conn->query($billing_query);
if (!$billing_result || $billing_result->num_rows === 0) {
    die("Invalid Billing ID or No Invoice Found.");
}
$billing = $billing_result->fetch_assoc();

// Fetch patient details
$patient_query = "SELECT * FROM patients WHERE id = " . $billing['patient_id'];
$patient = $conn->query($patient_query)->fetch_assoc();

// Fetch billing items
$items_query = "
    SELECT bi.*, sm.name AS item_name, sm.price AS unit_price 
    FROM billing_items bi 
    JOIN services_medications sm ON bi.service_id = sm.id 
    WHERE bi.billing_id = $billing_id";
$billing_items = $conn->query($items_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .invoice-container {
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin-bottom: 0;
        }
        .invoice-header p {
            margin: 0;
            color: #6c757d;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>Generated on: <?= date('Y-m-d H:i:s') ?></p>
        </div>
        <div>
            <h5>Patient Details:</h5>
            <p><strong>Name:</strong> <?= $patient['name'] ?></p>
            <p><strong>Email:</strong> <?= $patient['email'] ?></p>
            <p><strong>Phone:</strong> <?= $patient['phone'] ?></p>
        </div>
        <table class="table table-bordered mt-4">
            <thead class="table-secondary">
                <tr>
                    <th>Item</th>
                    <th>Unit Price ($)</th>
                    <th>Quantity</th>
                    <th>Total Price ($)</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($item = $billing_items->fetch_assoc()): ?>
                <tr>
                    <td><?= $item['item_name'] ?></td>
                    <td><?= number_format($item['unit_price'], 2) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['total_price'], 2) ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
        <h5 class="text-end">Grand Total: $<?= number_format($billing['grand_total'], 2) ?></h5>

        <div class="invoice-footer">
            <a href="billing.php" class="btn btn-secondary">Back to Billing</a>
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
