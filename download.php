<?php
function is_safe($filename)
{
    if( ! file_exists($filename))
        return false;
    
    $pathinfo = pathinfo($filename);
    
    if( isset($pathinfo['extension']) && $pathinfo['extension'] == "png")
        return true;
    
    return false;
}

if( isset($_REQUEST['f']) && is_safe($_REQUEST['f'])):
    
    $download_name = $filename = $_REQUEST['f'];
     header('Content-Type: image/png'); // add here more headers for diff. extensions
     header("Content-Disposition: attachment; filename=\"".$download_name."\""); // use 'attachment' to force a download
    readfile($filename);
    unlink($filename);
endif;
