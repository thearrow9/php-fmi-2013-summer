<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="confirm_new_event">
    <form id="confirm_event" class="fancy_form">

        <p>Извлечена е следната информация за <strong><?=$title;?></strong>:</p>

        <label for="cf_host_country_">Домакин:</label><input type="text" readonly id="cf_host_country" value="<?=$host_country;?>" />
        <div class="clear"></div>

        <label for="cf_champion">Шампион:</label><input type="text" readonly id="cf_champion" value="<?=$champion;?>" />
        <div class="clear"></div>

        <label for="cf_num_teams">Брой отбори:</label><input type="text" id="cf_num_teams" value="<?=$num_teams;?>" />
        <div class="clear"></div>

        <label for="cf_start_date">Начална дата:</label><input type="text" readonly id="cf_start_date" value="<?=$start_date;?>" />
        <div class="clear"></div>

        <label for="cf_end_date">Крайна дата:</label><input type="text" id="cf_end_date" value="<?=$end_date;?>" />
        <div class="clear"></div>

        <label for="cf_teams">Участници:</label><select id="cf_teams" multiple size="<?=(int)count($teams) / 4;?>">

        <?php foreach($teams as $team) : ?>
            <option selected value="<?=$team['abbr'];?>"><?=$team['name'];?></option>
        <?php endforeach;?>
        </select>
        <div class="clear"></div>
<?php if(count($optional_abbrs)) : ?>

<p>Непознати за мен отбори:</p>
<?php foreach($optional_abbrs as $abbr) : ?>

<p><?=$abbr;?></p>

<?php endforeach; ?>

<?php endif;?>
    </form>
</div>
