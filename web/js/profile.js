$(function(){

    $(document).on('click','.update_value',function(e){
        var form = $(this).closest('form');
        var action = form.attr('action');
        $.ajax({
            url:action,
            data:form.serialize(),
            type:'POST',
            success:function(response){
                if(response)
                {
                    $('#valueId_'+response.id).popoverX('hide');
                    $.pjax.reload({container:'#values'});
                    $('button').popoverButton();
                }
            },
            error:function(){
                alert('Error');
            }
        });
    });

    $(document).on('click','.delete_value',function(){
        var id = $(this).data('del');
        $.ajax({
            url:'/values/delete',
            data:{id:id},
            type:'GET',
            success:function(response){
                if(response)
                {
                    $.pjax.reload({container:'#values'});
                }
            },
            error:function(){
                alert('Error');
            }
        });
    });

});