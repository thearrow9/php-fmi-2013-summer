server = 'http://localhost/fmi_project/index.php/';

function print_system_message(string)
{
    if(string == '')
        return;
    $('#system_message').html(string).show();
}


function hide_system_message()
{
    $('#system_message').hide();
}

$(document).ready(function()
{
});
