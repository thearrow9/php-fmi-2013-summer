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
    <div id="modal"></div>

    <?=build_html($html);?>

</body>
</html>
