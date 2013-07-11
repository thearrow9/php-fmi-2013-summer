<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method="post" id="event_form" class="fancy_form">

    <label for="event_name">Име на футболен турнир</label>
    <input type="list" required placeholder="пишете на латицина!" value="Fifa world cup" size="40" id="event_name" pattern="^[a-zA-Z\s]{3,}$" title="Името трябва да е поне 3 символа и на латиница." />
    <?=build_datalist('event_name');?>
    <div class="clear"></div>

    <label for="event_start_year">Коя година започва?</label>
    <input type="number" value="<?='1990';#date('Y');?>" step="1" min="1900" max="2100" id="event_start_year" />
    <div class="clear"></div>

    <label for="event_type">Тип на турнира</label>
    <select id="event_type">
        <option value="0">Национални отбори</option>
        <!--<option value="1">Клубни отбори</option>-->
    </select>
    <div class="clear"></div>

    <label for="even_srlimit">Колко предложения да покажa?</label>
    <input type="number" value="4" step="1" min="1" max="100" id="event_srlimit" />
    <div class="clear"></div>

    <input type="image" src="<?=base_url('img/yes.png');?>" />
    <div class="clear"></div>
</form>

<div id="event_responce"></div>
