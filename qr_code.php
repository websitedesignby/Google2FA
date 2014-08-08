<?php
// application level variables
define('DEBUG', false);
define('GENERATE_QR_CODE', false); // generates and saves image to hd

if( DEBUG ):
    ini_set ('display_errors', 'true');
    error_reporting(E_ALL);
endif;

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

$domain = "";
if(isset($_POST['action']) && ( $_POST['action'] == $form_action )):

    $domain = $_POST['domain'];
    $secret_key = Google2FA::generate_secret_key();
    $qr_code_url = "http://chart.googleapis.com/chart?chs=200x200&chld=M%7C0&cht=qr&chl=otpauth://totp/" . $domain . "?secret=" . $secret_key;
    

    $img = imagecreatefromstring(file_get_contents($qr_code_url));
    
    $filename = filename_safe($domain);
    $filepath = $filename.'_qr_code_' . md5(uniqid()) . '.png';
    imagepng($img, $filepath);
    
endif;
     
$page_title = "Google TOTP Two-factor Authentication for PHP QR Code Generator";
$page_description = "Demonstration and source code of Google TOTP Two-factor Authentication for PHP QR Code Generator";
$menu1_class = "active";
require_once('template-top.php'); 
require_once('nav-top.php'); 

?>
        <form role="form" name="qr_code_inputs" method="post">
            <input type="hidden" name="action" value="<?php echo $form_action; ?>" />
            <div class="form-group">
                <label for="domain">Domain:</label> <input name="domain" placeholder="Enter a domain" value="<?php echo $domain; ?>" class="form-control" />
                <p class="help-block">Enter a unique domain such as your-website-address.com.</p>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <?php if( isset($qr_code_url)): ?>
            <?php if(DEBUG): ?>
            <p><a href="<?php echo $qr_code_url; ?>" target="_blank"><?php echo $qr_code_url; ?></a></p>
            <?php endif; ?>
            <p style="padding-top:20px;"><img src="<?php echo $qr_code_url; ?>" /></p>
            <p><strong>Domain:</strong> <?php echo $domain; ?></p>
            <p><strong>Secret:</strong> <?php echo $secret_key; ?></p>
            <?php if(GENERATE_QR_CODE): ?>
            <p><a href="download.php?f=<?php echo $filepath; ?>">Download QR Code</a></p>
            <?php endif; ?>            
        <?php endif; ?>
            
<?php require_once('template-bottom.php'); ?>
