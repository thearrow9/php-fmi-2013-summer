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
            url: server + "insert/suggest_event/",
            data: post_data,
            asyncr: false
            }).done(function(msg)
            {
                hide_system_message();
                $('#event_responce').html(msg);
        });
        return false;
    });

    $('body').on('click', '#event_suggestions p', function()
    {
        print_system_message('Прочитам статията...');
        var post_data = { title: $(this).html() };
        $.ajax
        ({
            type: 'POST',
            url: server + 'insert/event/',
            data: post_data
        }).done(function(html)
        {
            hide_system_message();
            $('body').append(html);
            console.log(html);
        });
    });
});
