server = 'http://localhost/fmi_project/index.php/';

function print_system_message(string)
{
    if(string == '')
        return;
    $('#system-message').html(string).show();
}


function hide_system_message()
{
    $('#system-message').hide();
}

$(document).ready(function()
{
});
