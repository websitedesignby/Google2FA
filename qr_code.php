<?php
ini_set ('display_errors', 'true');
error_reporting(E_ALL);

require_once('Google2FA.php');

$form_action = 'build-qr-code';

function filename_safe($filename, $space_char = "_")
{
    
    $temp = trim($filename);

    // Lower case

    $temp = strtolower($temp);

    // Replace spaces with a $space_char

    $temp = str_replace(" ", $space_char, $temp);

    // Loop through string
    $result = '';

    for ($i=0; $i<strlen($temp); $i++) {
        if (preg_match('([0-9]|[a-z]|_|\.)', $temp[$i])) {
            $result = $result . $temp[$i];
        }
    }

    // Return filename
    return $result;

}

$domain = $secret = "";
if(isset($_POST['action']) && ( $_POST['action'] == $form_action )):

    $domain = $_POST['domain'];
    $secret = $_POST['secret'];
    $secret_key = Google2FA::generate_secret_key();
    $qr_code_url = "http://chart.googleapis.com/chart?chs=200x200&chld=M%7C0&cht=qr&chl=otpauth://totp/" . $domain . "?secret=" . $secret_key;
    
    $img = imagecreatefromstring(file_get_contents($qr_code_url));
    
    $filename = filename_safe($domain);
    $filepath = $filename.'_qr_code_' . md5(uniqid()) . '.png';
    imagepng($img, $filepath);
    
endif;
     
?>
<html>
    <head>
        <title>Google 2 Factor Authentication QR Code Generator</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <form name="qr_code_inputs" method="post">
            <input type="hidden" name="action" value="<?php echo $form_action; ?>" />
            <ul>
                <li><strong>Domain:</strong> <input name="domain" value="<?php echo $domain; ?>" /></li>
                <li><strong>Secret:</strong> <input name="secret" /></li>
                <li><input type="submit" value="Generate QR Code" /></li>
            </ul>
        </form>
        <?php if( isset($qr_code_url)): ?>
            <p><a href="<?php echo $qr_code_url; ?>" target="_blank"><?php echo $qr_code_url; ?></a></p>
            <p><img src="<?php echo $filepath; ?>" /></p>
            <p><a href="download.php?f=<?php echo $filepath; ?>">Download QR Code</a></p>
            <p><strong>Domain:</strong> <?php echo $domain; ?></p>
            <p><strong>Secret:</strong> <?php echo $secret_key; ?></p>
        <?php endif; ?>
    </body>
</html>

