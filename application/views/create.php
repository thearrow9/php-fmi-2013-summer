<?php if( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<form method="post" id="event_form">
    <div>
    <input type="text" placeholder="Име на футболен турнир" size="40" name="event_name" />
    <input type="number" placeholder="Коя година започва?" value="<?=date('Y');?>" step="1" min="1900" max="2100" name="start_year" />
    <select name="type">
        <option value="0">Национални отбори</option>
        <option value="1">Клубни отбори</option>
    </select>
    </div>
    <div>
        <input type="submit" value="Създай турнир!" />
    </div>
</form>
