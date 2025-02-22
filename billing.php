<?php
include('connection.php');

// افتراض أنك ستقوم بإضافة الفاتورة بناءً على بيانات POST
$patientId = $_POST['patientId'] ?? '';
$patientName = $_POST['patientName'] ?? '';
$billItems = $_POST['billItems'] ?? [];
$grandTotal = 0;

if (!empty($billItems)) {
    foreach ($billItems as $item) {
        $grandTotal += $item['unitPrice'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Interface</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Poppins', sans-serif;
        }
        .billing-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .billing-header {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }
        .form-label {
            font-weight: 600;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .table tbody tr td {
            font-size: 16px;
        }
        .btn-generate {
            background-color: #28a745;
            color: #fff;
            font-weight: 600;
        }
        .btn-generate:hover {
            background-color: #218838;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .invoice-table th, .invoice-table td {
            vertical-align: middle;
        }
        .remove-item {
            background-color: #e74a3b;
            color: #fff;
        }
        .remove-item:hover {
            background-color: #c0392b;
        }
        .grand-total {
            font-weight: 700;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="billing-container">
    <div class="billing-header">
        <h1> Billing Interface</h1>
        <p class="text-muted">Create and manage invoices with ease</p>
    </div>

    <!-- Form for Input -->
    <form method="POST" action="">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="patientId" class="form-label">Patient ID</label>
                <input type="text" id="patientId" name="patientId" class="form-control" value="<?php echo $patientId; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="patientName" class="form-label">Patient Name</label>
                <input type="text" id="patientName" name="patientName" class="form-control" value="<?php echo $patientName; ?>" required>
            </div>
        </div>

        <!-- Service Select -->
        <div class="mb-3">
            <label for="service" class="form-label">Select Service/Medication</label>
            <select id="service" class="form-select">
                <option value="">Select an option</option>
                <?php
                $services = $conn->query("SELECT id, name, price FROM services_medications");
                while ($service = $services->fetch_assoc()) {
                    echo "<option value='{$service['id']}' data-price='{$service['price']}'>{$service['name']} - $ {$service['price']}</option>";
                }
                ?>
            </select>
        </div>
        
        <!-- Quantity Input -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" id="quantity" class="form-control" min="1" required>
        </div>

        <!-- Add Item Button -->
        <div class="text-end">
            <button type="button" class="btn btn-secondary" id="addToBill">Add to Bill</button>
        </div>
    </form>

    <!-- Bill Summary -->
    <h3>Bill Summary</h3>
    <table class="table table-bordered invoice-table">
        <thead>
            <tr>
                <th>Service/Medication</th>
                <th>Unit Price ($)</th>
                <th>Quantity</th>
                <th>Total ($)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="billItems">
            <!-- Dynamic bill items will be added here -->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end">Grand Total:</td>
                <td id="grandTotal" class="grand-total">0.00</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <!-- Generate Invoice Button -->
    <div class="text-end">
        <button type="submit" class="btn btn-generate">Generate Invoice</button>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const addToBillButton = document.getElementById("addToBill");
        const serviceSelect = document.getElementById("service");
        const quantityInput = document.getElementById("quantity");
        const billItems = document.getElementById("billItems");
        const grandTotalElement = document.getElementById("grandTotal");

        let grandTotal = 0;

        addToBillButton.addEventListener("click", () => {
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const serviceName = selectedOption.text.split(" - ")[0];
            const unitPrice = parseFloat(selectedOption.getAttribute("data-price"));
            const quantity = parseInt(quantityInput.value);

            if (!quantity || quantity < 1) {
                alert("Please enter a valid quantity.");
                return;
            }

            const totalPrice = unitPrice * quantity;
            grandTotal += totalPrice;

            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${serviceName}</td>
                <td>${unitPrice.toFixed(2)}</td>
                <td>${quantity}</td>
                <td>${totalPrice.toFixed(2)}</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-item">Remove</button></td>
            `;
            billItems.appendChild(row);

            grandTotalElement.textContent = grandTotal.toFixed(2);

            // Remove Item
            row.querySelector(".remove-item").addEventListener("click", () => {
                grandTotal -= totalPrice;
                grandTotalElement.textContent = grandTotal.toFixed(2);
                row.remove();
            });

            // Reset form fields
            serviceSelect.value = "";
            quantityInput.value = "";
        });
    });
</script>

</body>
</html>
