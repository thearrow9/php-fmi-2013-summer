<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method="post" id="event_form">
    <div>
    <input type="list" required placeholder="Име на футболен турнир" value="Fifa" size="40" id="event_name" pattern="^[a-zA-Z\s]{3,}$" title="Името трябва да е поне 3 символа и на латиница." />
    <?=build_datalist('event_name');?>
    <input type="number" placeholder="Коя година започва?" value="<?=date('Y');?>" step="1" min="1900" max="2100" id="event_start_year" />
    <select id="event_type">
        <option value="0">Национални отбори</option>
        <option value="1">Клубни отбори</option>
    </select>
    </div>
    <div>
    Колко предложения да покажа:
    <input type="number" value="10" step="1" min="1" max="100" id="event_srlimit" />
        <input type="submit" value="Създай турнир!" />
    </div>
</form>

<div id="event_responce"></div>
