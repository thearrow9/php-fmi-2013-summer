event_form_ids = ['name', 'start_year', 'type', 'srlimit'];

$(document).ready(function()
{
    $mask = $('#mask');
    $modal = $('#modal');
    $body = $('body');

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

    $body.on('click', '#event_suggestions p', function()
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
            $mask.fadeIn();
            $modal.html(html_code).fadeIn();
        });
    });

    $body.on('click', '.insert_abbr', function()
    {
        var $input = $(this).prev();
        var input_id = $input.attr('id');
        var abbr = input_id.substring(input_id.length - 3);
        var country_name = $input.val();

        $.ajax
        ({
            type: 'POST',
            url: server + 'ajax/insert_old_abbr',
            data: { abbr: abbr, name: country_name  }
         }).done(function(status_code)
        {
            if(status_code < 1)
            {
                print_system_message('Няма добавени записи', 3000);
                return;
            }

            $('#cf_teams').prepend($('<option>', {
                value: abbr,
                text : country_name,
                selected: true
            }));
            increment_teams();
            console.log(status_code);
            $('#new_' + abbr).fadeOut();
            print_system_message('Записът е добавен', 3000);
        });
    });

    $body.on('submit', '#cf_event', function()
    {
        
    });

    $body.on('click', '#cf_reject', function()
    {
        $mask.fadeOut();
        $modal.fadeOut();
    });

});
