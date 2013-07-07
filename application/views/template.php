<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>

<?=meta($meta);?>

<title><?=$page_title;?></title>

<?=build_css($css);?>

<?=build_js($js);?>

</head>
<body>
    <div id="mask"></div>
    <div id="system_message"></div>
    <?=$html;?>
    <div id="modal"></div>
</body>
</html>
