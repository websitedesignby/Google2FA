<?php

/**
require_once('Google2FA.php');

$InitalizationKey = "PEHMPSDNLXIOG65U";					// Set the inital key

$TimeStamp	  = Google2FA::get_timestamp();
$secretkey 	  = Google2FA::base32_decode($InitalizationKey);	// Decode it into binary
$otp       	  = Google2FA::oath_hotp($secretkey, $TimeStamp);	// Get current token

echo("Init key: $InitalizationKey\n");
echo("Timestamp: $TimeStamp\n");
echo("One time password: $otp\n");

// Use this to verify a key as it allows for some time drift.

$key = "596432"; // user input;

$result = Google2FA::verify_key($InitalizationKey, $key);

var_dump($result);

**/
?>
<html>
    <head>
        <title>Google 2 Factor Authentication QR Code Generator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <ol>
            <li><a href="qr_code.php">Create a QR Code</a></li>
            <li><a href="authenticate.php">Authenticate</a></li>
        </ol>
    </body>
</html>