server = 'http://localhost/fmi_project';

$(document).ready(function()
{
    $('#event_form').submit(function()
    {
        var event_name = $(this).find('input[name="event_name"]').val();
        var start_year = $(this).find('input[name="start_year"]').val();
        var event_type = $(this).find('select[name="event_type"]').val();

        $.ajax(
        {
            type: "POST",
            url: server + "/index.php/insert/suggest_event/",
            data: { event_name: event_name }
            }).done(function( msg ) {
            console.log( "Data Saved: " + msg );
        });
        return false;
    });
});
