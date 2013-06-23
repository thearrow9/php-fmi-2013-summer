$(document).ready(function()
{
    $('#event_form').submit(function()
    {
        var event_name = $(this).find('input[name="event_name"]').val();
        var start_year = $(this).find('input[name="start_year"]').val();
        var event_type = $(this).find('select[name="event_type"]').val();

        $.ajax(
        {
            type: "",
            url: "",
            data: { }
            }).done(function( msg ) {
            alert( "Data Saved: " + msg );
        });
        return false;
    });
});
