<?php
session_start();
if (!isset($_SESSION['txn_ref'])) {
    header("Location: index.php");
    exit();
}

$amount = $_SESSION['amount'];
$method = $_SESSION['payment_method'];
$txn_ref = $_SESSION['txn_ref'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complete Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-xl shadow-lg max-w-md w-full text-center">
        
        <?php if($method == 'Bank Transfer'): ?>
            <!-- BANK TRANSFER VIEW -->
            <div class="mb-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="landmark" class="w-8 h-8 text-blue-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Manual Bank Transfer</h2>
                <p class="text-gray-500 mt-2">Please transfer <span class="font-bold text-gray-900">PKR <?php echo $amount; ?></span> to the account below.</p>
            </div>

            <div class="bg-gray-100 p-4 rounded-lg text-left text-sm space-y-2 mb-6 border border-gray-200">
                <p><span class="font-semibold text-gray-700">Bank Name:</span> Meezan Bank</p>
                <p><span class="font-semibold text-gray-700">Account Title:</span> FeedbackSaaS Corp</p>
                <p><span class="font-semibold text-gray-700">Account No:</span> 0101-01012345-01</p>
                <p><span class="font-semibold text-gray-700">Reference ID:</span> <?php echo $txn_ref; ?></p>
            </div>

            <p class="text-xs text-gray-400 mb-4">
                We have saved your Bank Name/IBAN. Once you transfer the amount, click the button below to confirm.
            </p>

            <form action="payment_success.php" method="POST">
                <input type="hidden" name="txn_ref" value="<?php echo $txn_ref; ?>">
                <input type="hidden" name="status" value="success">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                    I Have Transferred the Amount
                </button>
            </form>

        <?php else: ?>
            <!-- EASYPAISA / JAZZCASH VIEW -->
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Confirm Payment</h2>
            <p class="text-gray-500 mb-6">Pay <strong>PKR <?php echo $amount; ?></strong> via <?php echo $method; ?></p>

            <div class="bg-yellow-50 border border-yellow-200 p-4 rounded text-sm text-yellow-800 text-left mb-6">
                <strong>Simulation Mode:</strong> Click "Pay Now" to simulate a successful API transaction.
            </div>

            <form action="payment_success.php" method="POST">
                <input type="hidden" name="txn_ref" value="<?php echo $txn_ref; ?>">
                <input type="hidden" name="status" value="success">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg">
                    Pay Now
                </button>
            </form>
        <?php endif; ?>

    </div>
    <script>lucide.createIcons();</script>
</body>
</html>