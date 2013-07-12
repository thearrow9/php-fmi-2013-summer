server = 'http://localhost/fmi_project/index.php/';


function print_system_message(string, time)
{
    if(string == '')
        return;

    if(typeof(time) == 'undefined')
    {
        $system_message.html(string).show();
    }
    else
    {
        $system_message.html(string).show(0).delay(parseInt(time)).hide(0);
    }
}


function hide_system_message(time)
{
    $system_message.delay(time).hide();
}

function increment_teams()
{
    $up = $('#num_known');
    $down = $('#num_unknown');
    $up.html(parseInt($up.html()) + 1);
    $down.html(parseInt($down.html() - 1));
}

$(document).ready(function()
{
    $system_message = $('#system_message');
});
