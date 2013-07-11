event_form_ids = ['name', 'start_year', 'type', 'srlimit'];

$(document).ready(function()
{
    $('#event_form').on('submit', function()
    {
        print_system_message('Изпращам заявката...');
        var post_data = {};
        for (element in event_form_ids)
        {
            post_data[event_form_ids[element]] = $(this).find('#event_' + event_form_ids[element]).val();
        }

        $.ajax(
        {
            type: "POST",
            url: server + "ajax/suggest_event/",
            data: post_data,
            asyncr: false
            }).done(function(html_code)
            {
                hide_system_message();
                $('#event_responce').html(html_code).data('year', post_data['start_year']);
        });
        return false;
    });

    $('body').on('click', '#event_suggestions p', function()
    {
        print_system_message('Прочитам статията...');
        var post_data = { year: $('#event_responce').data('year'), title: $(this).html() };
        $.ajax
        ({
            type: 'POST',
            url: server + 'ajax/read_event/',
            data: post_data
        }).done(function(html_code)
        {
            hide_system_message();
            $('#mask').fadeIn();
            console.log(html_code);
            $('#modal').html(html_code).fadeIn();
        });
    });
});
