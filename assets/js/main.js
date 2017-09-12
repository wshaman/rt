$(function () {
    $('a.run-as-ajax').click(function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $('#updateFormPopup').find('.modal-body').html('Loading');
        $('#updateFormPopup').modal('show');
        $.ajax(url).done(function (data) {
            $('#updateFormPopup').find('.modal-body').html(data);

        });
        return false;
    });

    // $('.modal').on('submit', 'form')(function (e) {
    //     e.preventDefault();
    //     console.log(e);
    // });

    $('.btn-modal-save').click(function (e) {
        //@todo: Запилить закрытие после валидации
        $(this).parents('div.modal-body').eq(0).find('form').trigger('submit');
        $(this).parents('modal').eq(0).modal('hide');
    });
    $('table').on('change', 'select.js__form_field_autosave', function(e){
        var _this = $(this);
        var data = {__type: 'simple'};
        data[$(this).attr('name')] = $(this).val();
        $.post(_this.data('href'), data, function (data) {
            //@todo: Добавить OK.
        })
    })
});