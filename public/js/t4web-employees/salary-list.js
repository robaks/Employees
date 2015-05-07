$(function() {

    initTooltip();

    $('body').on("click", "a.edit-salary", function () {
        var id = $(this).data('id');
        var employeeId = $(this).data('employeeid');
        var date = $(this).data('date');
        var amount = $(this).data('amount');
        var currency = $(this).data('currency');
        var comment = $(this).data('comment');

        $(".modal-body").find('input[name="id"]').val(id);
        $(".modal-body").find('input[name="employeeId"]').val(employeeId);
        $(".modal-body").find('input[name="amount"]').val(amount);
        $(".modal-body").find('select[name="currency"]').val(currency);
        $(".modal-body").find('textarea[name="comment"]').val(comment);
        $(".modal-body").find('input[name="date"]').val(date);

        $('#salary-modal').modal('show');
    });

    $('body').on("click", "#salary-modal .btn-primary", function () {
        var form = $(this).parents().find('form');

        /* remove error messages */
        if(form.find('div').hasClass('has-error')) {
            form.find('div').removeClass('has-error');

            form.find('div p.help-block').remove();
        }

        var data = form.serializeArray();

        var employeeId = $.map(data, function(e, k) {
            if(e.name === 'employeeId') {
                return e.value;
            }
        }).join();

        $.ajax({
            url: '/employee/'+employeeId+'/salary-ajax/save',
            type: 'POST',
            global: false,
            async: false,
            dataType: 'json',
            data: data,
            success: function(response) {

                /* draw errors */
                if (response.errors) {
                    $.each(response.errors, function (field, errors) {
                        var parent = form.find('.form-control[name=' + field + ']').closest('div');

                        parent.addClass('has-error');

                        $.each(errors, function (key, error) {
                            parent.append('<p class="help-block">' + error + '</p>');
                        });
                    });

                    return false;
                }

                var data = response.formData;
                var currenies = getCurrencies();

                var date = new Date(data.date);

                var tdId = data.employeeId + '-' + parseInt(date.getMonth() + 1);
                var el = $('#salaries-list').find('td#' + tdId).find('a');

                el.data('id', data.id);
                el.data('employeeid', data.employeeId);
                el.data('comment', data.comment);
                el.data('currency', data.currency);
                el.data('amount', data.amount);

                el.attr('data-original-title', data.comment);
                initTooltip();

                el.text(data.amount + ' ' + currenies[data.currency]);
                $('#salary-modal').modal('hide');
            }
        });
    });

    /**
     * get currencies
     */
    function getCurrencies() {
        var result = {};

        $.ajax({
            url: '/employee/salary-ajax/currencies',
            type: 'GET',
            global: false,
            async: false,
            dataType: 'json',
            success: function(data) {
                result = data.formData;
            },
            error: function (response) {
                bootbox.alert({
                    message: response.statusText,
                    className: "bootbox-sm"
                });
            }
        });

        return result;
    }
});

function initTooltip() {
    $('[data-toggle="tooltip"]').tooltip({
        'container': 'body',
        'placement': 'top'
    });
}