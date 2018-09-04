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

    //Редактирование цели
    $(document).on('blur, change','#form-input-goal-update input, select, textarea',function()
    {
        $('#form-input-goal-update').submit();
        $.pjax.reload({container:'#pjax-form-input-goal-update'});
    });

    $(document).on('click','#delete_photo_update_goal',function()
    {
        $.ajax({
            url: '/goals/delete-file'+location.search,
            type: 'POST',
            success: function(response) {
                $.pjax.reload({container:'#pjax-form-input-goal-update'});
            }
        });
    });

    $(document).on('click','.update_stages_goal',function(){

        var data = new FormData();
        var name;

        $.each($('.new_stage').find("input, textarea"), function(index,value){

            //name = $(value).attr('name').replace(/\d/,index);
            console.log($(value).attr('name'));

            data.append($(value).attr('name'),$(value).val());
            data.append('goal_id',$('.goal').data('goal_id'));
        });
        $.ajax({
            url: '/goals/add-stages',
            data:data,
            type: 'POST',
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status)
                {
                    $.pjax.reload({container:'#pjax-form-input-goal-update'});
                }
            }
        });
    });

    jQuery('#multiple-input').on('afterDeleteRow', function(e, row) {
        $.ajax({
            url:'/goals/delete-stage',
            data:{stageId:row.attr('data-stageId')},
            type:'POST',
            success:function(response){
                $.pjax.reload({container:'#pjax-form-input-goal-update'});
            },
            error:function(){
                alert('Error');
            }
        });
    });

});