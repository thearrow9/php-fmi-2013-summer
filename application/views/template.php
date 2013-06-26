<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
;?><!DOCTYPE html>
<html>
<head>

<?=meta($meta);?>

<title><?=$page_title;?></title>

<?=build_css_links($css);?>

<?=build_js_scripts($js);?>

</head>
<body>
    <div id="system-message"></div>
    <?=$html;?>
</body>
</html>
