
    $(document).ready(function(){
        $('#blogin').click(login);
    });

    function login(event){
        event.preventDefault();
        event.stopPropagation();
        var user = $('#user').val();
        var pass = $('#pass').val();
        if(user!="" && pass!=""){
            $('#errorLogin').html("<img class='loader' src='img/preloaderPartes.gif' alt='Cargando...'/>");
            $('#formLogin').submit();
        }else{
            $('#errorLogin').html('Introduce usuario y contraseña');
        }
    }

