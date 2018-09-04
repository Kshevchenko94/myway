$(function() {

    $(document).on('click','#save_btn',function(){
        var form_news = $('#news_form')[0];
        var data = new FormData(form_news);
        var action = form_news.action;

        $.ajax({
            url: action,
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {
                if(response.status)
                {
                    $.pjax.reload({container:'#pjax_news'});
                }

            }
        });
    });

    $(document).on('blur, change','.update_news_form input, textarea',function(){
        var form_news = $(this).closest('.update_news_form')[0];
        var data = new FormData(form_news);
        var action = form_news.action;

        $.ajax({
            url: action,
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {
                if(response.status)
                {
                    $.pjax.reload({container:'#pjax_update_form'});
                }

            }
        });
    });

    $(document).on('click','.rm_file',function(){
        var id_news = $(this).data('id_news');
        $.get('/news/delete-file/',{id_news:id_news},function(response){
            if(response.status)
            {
                $.pjax.reload({container:'#pjax_update_form'});
            }
        });
    });

    $(document).on('click','.del_news',function(){
        var id_news = $(this).closest('.news').data('id-element');
        $.get('/news/delete/',{id_news:id_news},function(response){
            if(response.status)
            {
                $.pjax.reload({container:'#pjax_news'});
            }
        });
    });

    $(document).on('hide.bs.modal','.modal_update_news', function (e) {
        $.pjax.reload({container:'#pjax_news'});
    });
});