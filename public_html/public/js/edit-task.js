$(document).ready(function () {
   $('body').on('click','.task',function (e) {
       let text = $(this).text();
        $(this).html('<input id="edit" type="text" name="edit_task" value="'+text+'">');
        $('#edit').focus();
        e.stopPropagation();
   });

    $('body').on('click','.editer',function (e) {
        e.preventDefault();
        let val = $('#edit').val();
        let url = $(this).attr('href');
        if(val){
            $(this).parent().parent().find('.task').html(val);


            let request = $.ajax({
                url: url,
                data:{val:val},
                method:'GET',
                dataType:'text'
            });
        }



    });
});