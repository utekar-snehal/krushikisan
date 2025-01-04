<?php
// Stripe Integration Example with QR Code Scanning (Single Page PHP)

require 'vendor/autoload.php';  // Include Stripe's PHP library

\Stripe\Stripe::setApiKey('your_stripe_secret_key'); // Your Stripe secret key

// Create a Checkout Session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Product Name',
                        ],
                        'unit_amount' => 5000, // Price in cents (5000 = $50)
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'https://your-website.com/success.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'https://your-website.com/cancel.php',
        ]);

        // Return session ID to frontend
        echo json_encode(['id' => $session->id, 'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($session->url)]);
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment Integration with QR Code Scanner</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsQR/dist/jsQR.js"></script> <!-- QR Code scanning library -->
</head>
<body>

<h2>Stripe Payment Integration with QR Code</h2>

<!-- QR Code Scanner -->
<h3>Scan QR Code to Pay</h3>
<video id="scanner" width="300" height="200"></video>

<!-- Payment Form -->
<div id="payment-form" style="display:none;">
    <button id="checkout-button">Checkout</button>
</div>

<!-- QR Code Image (for testing) -->
<h3>Or Scan this QR Code for Payment</h3>
<img id="qr-code" src="" alt="Payment QR Code" width="200"/>

<script>
// Get Stripe publishable key from your dashboard
var stripe = Stripe('your_stripe_publishable_key');  // Your Stripe publishable key

// Handle QR code scanning
var scanner = document.getElementById("scanner");
var video = document.createElement("video");
navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
    scanner.srcObject = stream;
    scanner.play();
    requestAnimationFrame(scanQRCode);
});

function scanQRCode() {
    var canvas = document.createElement("canvas");
    var context = canvas.getContext("2d");
    if (scanner.readyState === scanner.HAVE_ENOUGH_DATA) {
        canvas.height = scanner.videoHeight;
        canvas.width = scanner.videoWidth;
        context.drawImage(scanner, 0, 0, canvas.width, canvas.height);
        var imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        var code = jsQR(imageData.data, canvas.width, canvas.height);
        if (code) {
            // If QR code is detected, fill the form and proceed to payment
            console.log("QR Code data: " + code.data);
            var sessionId = code.data.split("session_id=")[1];  // Assuming session_id is embedded in the URL
            if (sessionId) {
                fillPaymentForm(sessionId);
            }
        }
    }
    requestAnimationFrame(scanQRCode);
}

// Fill the payment form automatically
function fillPaymentForm(sessionId) {
    fetch('/path_to_this_page.php', { // Same PHP page where the POST request is handled
        method: 'POST',
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (sessionData) {
        // If the QR code session_id matches the one returned
        if (sessionData.id === sessionId) {
            // Show the payment button
            document.getElementById("payment-form").style.display = 'block';
            document.getElementById("qr-code").src = sessionData.qr_code_url;
        }
    })
    .catch(function (error) {
        console.error('Error:', error);
    });
}

// Trigger checkout button click
document.getElementById('checkout-button').addEventListener('click', function () {
    fetch('/path_to_this_page.php', { // This is the server-side script we created earlier
        method: 'POST',
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (sessionId) {
        return stripe.redirectToCheckout({ sessionId: sessionId.id });
    })
    .then(function (result) {
        if (result.error) {
            alert(result.error.message);
        }
    })
    .catch(function (error) {
        console.error('Error:', error);
    });
});
</script>

</body>
</html>
