$(function(){


    $(document).on('click','.closed_goal',function(event)
    {
        var status = $(this).data('status');
        var id = $(this).data('id');
        $.ajax({
            url:'/goals/update-status',
            type:'GET',
            data:{id:id, status:status},
            success:function (response) {
                if(response.msg == 'ok')
                {
                    $('#goalsPopover'+response.id).popoverX('hide');
                    if($('#goal_'+response.id).length){
                        $.pjax.reload({container:'#goal_'+response.id});
                    }else if ($('#goal_view_'+response.id).length){
                        $.pjax.reload({container:'#goal_view_'+response.id});
                    }

                    const toast = swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,

                    });
                    if(status == 2)
                    {
                        toast({
                            type: 'success',
                            title: 'Цель выполнена!'
                        })
                    }else{
                        toast({
                            type: 'error',
                            title: 'Цель провалена!'
                        })
                    }

                }
            },
            error:function(){
                alert('Error!!!');
            }
        });
    });


    // Фильтр по целям.
    $(document).on('change','.group_goals, .priority_goal, .status',function(){
        $('#filter_goals').submit();
        $.pjax.reload({container:'#list_goals'});
    });

    // Добавление отчета по целям.
    $(document).on('click','#add_report_goals',function(){
        var report_form = $('#report_form')[0];
        var formData = new FormData(report_form);
        var action = report_form.action;

        $.ajax({
            url: action,
            data: formData,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(response) {
                $.pjax.reload({container:'#goal_view_'+response.model.id_goal});
            }
        });
    });

    $(document).on('click','#delete_photo_update_goal',function(){
        var opacity = $(this).siblings('img').css('opacity');
        if( opacity != 0.3)
        {
            $(this).siblings('img').fadeTo(600,0.3);
            $(this).removeClass('glyphicon-remove').html("Отменить");
            $('#goals-isdeletephoto').val(true);
        }else if(opacity == 0.3)
        {
            $(this).siblings('img').fadeTo(600,1);
            $(this).addClass('glyphicon-remove').html('');
            $('#goals-isdeletephoto').val(false);
        }

    });

});