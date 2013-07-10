<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="confirm_new_event">
<p>Домакин: <?=$host_country;?></p>
<p>Шампион: <?=$champion;?></p>
<p>Брой отбори: <?=$num_teams;?></p>
<p>Дата: <?=$dates;?></p>
<p>Отбори: <?php #print_r($teams);?></p>
<p>Нови отбори:<?php print_r($optional_abbrs);?></p>
</div>
