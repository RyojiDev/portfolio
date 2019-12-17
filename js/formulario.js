$(function() {


    $("body").on('submit', 'form.ajax-form', function() {
        let form = $(this);
        $.ajax({
            beforeSend: function() {
                $(".overlay-loading").fadeIn();
            },
            method: 'post',
            url: include_path + 'ajax/formularios.php',
            dataType: 'json',
            data: form.serialize()
        }).done(function(data) {
            if (data.sucesso) {


                $(".overlay-loading").fadeOut();
                $('.sucesso').fadeIn();
                setTimeout(function() {
                    $('.sucesso').fadeOut();
                }, 3000);
            } else {
                $(".overlay-loading").fadeOut();
                $('.error-message').fadeIn();
                setTimeout(function() {
                    $('.error-message').fadeOut();
                }, 3000);
                console.log("ocorreu um erro ao enviar o email");

            }

        });
        return false;
    });
});