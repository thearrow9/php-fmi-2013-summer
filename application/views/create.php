<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method="post" id="event_form">
    <div>
    <input type="list" required placeholder="Име на футболен турнир" size="40" name="event_name" pattern="^[a-zA-Z\s]{5,}$" title="Името трябва да е поне 5 символа и на латиница." />
    <?=build_datalist('event_name');?>
    <input type="number" placeholder="Коя година започва?" value="<?=date('Y');?>" step="1" min="1900" max="2100" name="start_year" />
    <select name="event_type">
        <option value="0">Национални отбори</option>
        <option value="1">Клубни отбори</option>
    </select>
    </div>
    <div>
        <input type="submit" value="Създай турнир!" />
    </div>
</form>

<div id="responce"></div>
