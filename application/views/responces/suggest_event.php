<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div>
    <p>Показвам <strong><?=$num_rows;?></strong> предложения.</p>
    <div id="event_suggestions">
        <?php
        foreach($rows as $row) : ?>

        <p><?=$row['title'];?></p>

        <?php endforeach; ?>
    </div>
</div>
