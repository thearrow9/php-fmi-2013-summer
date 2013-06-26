server = 'http://localhost/fmi_project';

function print_system_message(string)
{
    if(string == '')
        return;
    $('#system-message').html(string).show();
}


function hide_system_message()
{
    $('#system-message').fadeOut(2000);
}

$(document).ready(function()
{
    $('#event_form').submit(function()
    {
        print_system_message('Изпращам заявката...');
        var event_name = $(this).find('input[name="event_name"]').val();
        var start_year = $(this).find('input[name="start_year"]').val();
        var event_type = $(this).find('select[name="event_type"]').val();
        var srlimit = $(this).find('input[name="srlimit"]').val();

        $.ajax(
        {
            type: "POST",
            url: server + "/index.php/insert/suggest_event/",
            data: { event_name: event_name, start_year: start_year, event_type: event_type, limit: srlimit },
            asyncr: false
            }).done(function( msg ) {
            hide_system_message();
            $('#responce').html(msg);
        });
        return false;
    });
});
