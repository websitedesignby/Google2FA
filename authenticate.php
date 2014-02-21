<?php
ini_set ('display_errors', 'true');
error_reporting(E_ALL);

require_once('Google2FA.php');

$InitalizationKey = "";     // secret generated from qr_code.php

$form_action = 'authenticate';

if(isset($_POST['action']) && ( $_POST['action'] == $form_action )):

    // Use this to verify a key as it allows for some time drift.

    $key = $_POST['key']; // user input;

    $result = Google2FA::verify_key($InitalizationKey, $key);

endif;

?>
<html>
    <head>
        <title>Google OTP Authenticator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <h1>Authenticate Key</h1>
        <form name="qr_code_inputs" method="post">
            <input type="hidden" name="action" value="<?php echo $form_action; ?>" />
            <ul>
                <li><strong>Key:</strong> <input name="key" value="" /></li>
                <li><input type="submit" value="Authenticate Key" /></li>
            </ul>
        </form>
        <?php if( isset($result)): ?>
        <p><?php if( $result ): ?><strong>Correct!</strong><?php else: ?><strong>Incorrect :-(</strong><?php endif; ?></p>
        <?php endif; ?>
    </body>
</html>