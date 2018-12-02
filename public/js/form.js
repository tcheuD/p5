$('.delete').on('click', function(){

    var src = $(this).attr('src');
    var token = $(this).val();

    $.confirm({
        title: 'Confirmation',
        content: '' +
        '<form action="' + src +  '"  method="post" class="formName" id="jconfirm">' +
            '<input type="hidden" name="token" id="token" value="' + token +'" />' +
        '</form>',

        buttons: {
            formSubmit: {
                text: 'Confirmer',
                btnClass: 'btn-dark',
                action: function () {
                    $("#jconfirm").submit();
                }
            },
            cancelAction: {
                text: 'Annuler',
                btnClass: 'btn-dark',
                action: function () {

                }
            }
        }
    });
});
