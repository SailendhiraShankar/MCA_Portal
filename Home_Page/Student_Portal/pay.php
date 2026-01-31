<?php
session_start();
require('database.php');
if (!isset($_SESSION['ID'])) {
    header("Location: ulogin.php");
    exit;
}

// Run database update if needed (One-time check)
$check_col = $db->query("SHOW COLUMNS FROM payment LIKE 'transaction_image'");
if ($check_col->num_rows == 0) {
    $db->query("ALTER TABLE payment ADD COLUMN transaction_image VARCHAR(255) DEFAULT NULL");
    $db->query("ALTER TABLE payment MODIFY COLUMN status VARCHAR(50) DEFAULT 'pending'");
    $db->query("ALTER TABLE payment MODIFY COLUMN order_id VARCHAR(255) NULL");
}

$amount = $_POST['amount'] ?? '';
$title = $_POST['title'] ?? '';
$pid = $_POST['pid'] ?? '';

// If form submitted
if (isset($_POST['submit_payment'])) {
    $amount = $_POST['amount'];
    $pid = $_POST['pid'];
    $uid = $_SESSION['ID'];

    $target_dir = "payment/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_extension = pathinfo($_FILES["payment_proof"]["name"], PATHINFO_EXTENSION);
    $new_filename = "pay_" . uniqid() . "." . $file_extension;
    $target_file = $target_dir . $new_filename;

    if (move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $target_file)) {
        $order_id = "MANUAL_" . uniqid();
        $stmt = $db->prepare("INSERT INTO payment (order_id, rp_id, UID, price, status, transaction_image) VALUES (?, ?, ?, ?, 'pending', ?)");
        $final_amount = $amount / 100; // Database might store simplified amount
        $stmt->bind_param("sssis", $order_id, $pid, $uid, $final_amount, $target_file);

        if ($stmt->execute()) {
            header("Location: view_payment.php?status=pending");
            exit;
        } else {
            $error = "Database error: " . $db->error;
        }
    } else {
        $error = "Error uploading proof.";
    }
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>MCA Portal - Scan & Pay</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        :root {
            --primary: #7494ec;
            --white: #fff;
            --bg: #f5f7fb;
            --text: #333;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background: var(--white);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }

        h2 {
            color: var(--primary);
            margin-bottom: 20px;
        }

        .qr-code {
            width: 250px;
            height: 250px;
            object-fit: contain;
            margin-bottom: 20px;
            border: 2px solid #eee;
            padding: 10px;
            border-radius: 10px;
        }

        .amount-display {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text);
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #666;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px dashed #ccc;
            border-radius: 8px;
            background: #f9f9f9;
        }

        button {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #5a7ad6;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #777;
            font-size: 14px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Scan & Pay</h2>

        <p style="color: #666; margin-bottom: 20px;">
            Scan the QR code below using any UPI app (GPay, PhonePe, Paytm) to pay.
        </p>

        <!-- Display QR Code from payment folder -->
        <img src="../../payment/qr.jpeg" alt="UPI QR Code" class="qr-code">

        <div class="amount-display">
            ₹ <?php echo $amount / 100; ?>
        </div>

        <p style="font-size: 13px; color: #888; margin-bottom: 25px;">
            Paying for: <strong><?php echo htmlspecialchars($title); ?></strong>
        </p>

        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="hidden" name="title" value="<?php echo htmlspecialchars($title); ?>">

            <div class="form-group">
                <label>Upload Payment Screenshot</label>
                <input type="file" name="payment_proof" required accept="image/*">
            </div>

            <button type="submit" name="submit_payment">Confirm Payment</button>
        </form>

        <a href="view_payment.php" class="back-link">Cancel & Go Back</a>
    </div>
</body>

</html>