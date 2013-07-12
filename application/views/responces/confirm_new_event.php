<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="confirm_new_event">
    <form id="cf_event" class="fancy_form">

        <p>Извлечена е следната информация за <strong id="cf_title"><?=$title;?></strong>:</p>

        <input type="hidden" id="cf_start_time" value="<?=strtotime($start_date);?>" />
        <input type="hidden" id="cf_end_time" value="<?=strtotime($end_date);?>" />

        <label for="cf_host_country_">Домакин:</label><input type="text" readonly id="cf_host_country" value="<?=$host_country;?>" />
        <div class="clear"></div>

        <?php if( ! empty($host_country_two)): ?>

        <label for="cf_host_country_">Втори домакин:</label><input type="text" readonly id="cf_host_country_two" value="<?=$host_country_two;?>" />
        <div class="clear"></div>

        <?php endif;?>

        <label for="cf_champion">Шампион:</label><input type="text" readonly id="cf_champion" value="<?=$champion;?>" />
        <div class="clear"></div>

        <label for="cf_num_teams">Брой отбори:</label><input type="text" id="cf_num_teams" value="<?=$num_teams;?>" />
        <div class="clear"></div>

        <label for="cf_start_date">Начална дата:</label><input type="text" readonly id="cf_start_date" value="<?=$start_date;?>" />
        <div class="clear"></div>

        <label for="cf_end_date">Крайна дата:</label><input type="text" readonly id="cf_end_date" value="<?=$end_date;?>" />
        <div class="clear"></div>

        <label for="cf_teams">Участници (<span id="num_known"><?=$num_found_teams;?></span>)</label><select id="cf_teams" multiple size="<?=(int)count($teams) / 4;?>">

        <?php foreach($teams as $team) : ?>
            <option selected value="<?=$team['abbr'];?>"><?=$team['name'];?></option>
        <?php endforeach;?>
        </select>
        <div class="clear"></div>

<?php if($num_opt_teams) : ?>

<p>Непознати за мен отбори (<span id="num_unknown"><?=$num_opt_teams;?></span>)</p>
<?php foreach($optional_abbrs as $abbr) : ?>

<div id="new_<?=$abbr;?>">
<label for="unknown_<?=$abbr;?>">Дали <strong><?=$abbr;?></strong> е </label><input type="text" id="unknown_<?=$abbr;?>" placeholder="не открих нищо" value="<?=array_shift($suggestions);?>" />
<input type="button" value="Съхрани!" class="insert_abbr" />
</div>

<div class="clear"></div>

<?php endforeach; ?>

<?php endif;?>

        <div>
        <input type="submit" value="Съхрани" />
        <input type="button" value="Откажи" id="cf_reject" />
        </div>
        <div class="clear"></div>
    </form>
</div>
