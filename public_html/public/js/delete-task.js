$(document).ready(function(){
$('body').on('click','.delete',function(e){
    e.preventDefault();
    let url = $(this).attr('href');

    let request = $.ajax({
        url: url,
        method: 'GET',
        dataType:'text'
    });

    request.done(function( msg ) {
        $( "#result" ).html( msg );
    });
});
});