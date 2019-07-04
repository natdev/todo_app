$(document).ready(function(){
$('.delete').click(function(e){
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