$(document).ready(function(){
    $('.btn-add').click(function () {
       let tache_val =  $('#input_tache').val();
        let id = $('#id_user').val();
       let request = $.ajax({
           url:"/index/tache",
           method: "POST",
           data:{tache_val: tache_val, id: id},
           dataType: 'text'
       });

        request.done(function( msg ) {
            $( "#result" ).html( msg );
        });
    })
});