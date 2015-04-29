$(function() {
    initEditable();
    initDatapicker();

    /**
     * Save salary
     */
    $('body').on('click', '.btn-success', function() {
        var btn = $(this);
        var parentTr = $(this).parents('tr');
        var table = $(this).closest('table');

        /* remove error messages */
        if(parentTr.find('td').hasClass('has-error')) {
            parentTr.find('td').removeClass('has-error');

            parentTr.find('td p.help-block').remove();
        }

        /* get form data */
        var formData = [];
        parentTr.find('td').each(function(k, el) {

            $(el).find('.form-control').each(function(d, control) {
                var name = $(control).data('name');
                var value = $(control).val();

                name = name || $(control).attr('name');

                if(name !== undefined) {
                    formData[name] = value;
                }
            });

        });

        var employeeId = $(this).data('employee_id');
        var data = $.extend({}, formData);

        data.id = $(this).data('id') || null;

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
                        var parent = parentTr.find('.form-control[name=' + field + ']').closest('td');

                        parent.addClass('has-error');

                        $.each(errors, function (key, error) {
                            parent.append('<p class="help-block">' + error + '</p>');
                        });
                    });

                    return false;
                }

                var data = response.formData;

                /* if save new record */
                if(btn.hasClass('btn-success')) {
                    var currencies = getCurrencies();
                    var elements = '';

                    $.each(response.formData, function(n, v) {
                        if(n == 'date') {
                            elements += '<td><span data-value="'+v+'" data-name="'+n+'">'+data.formatDate+'</span></td>';
                        }

                        if(n == 'amount') {
                            elements += '<td class="text-right"><span data-value="'+v+'" data-name="'+n+'">'+v+'</span>&nbsp;';
                        }
                        if(n == 'currency') {
                            elements += '<span data-value="'+v+'" data-name="'+n+'">'+currencies[v]+'</span></td>';
                        }
                    });

                    var buttons = '<td>' +
                        '<button id="btn-calendar-edit" class="btn btn-xs btn-labeled btn-warning">' +
                        '<span class="btn-label icon fa fa-pencil"></span>Edit' +
                        '</button> ' +
                        '<button data-id="'+response.formData.id+'" style="display: none;" class="btn btn-primary">save</button> ' +
                        '<button id="btn-calendar-delete" data-id="'+response.formData.id+'" class="btn btn-xs btn-labeled btn-danger">' +
                        '<span class="btn-label icon fa fa-times"></span>Delete</button>' +
                        '</td>';

                    parentTr.before('<tr>'+elements+buttons+'</tr>');

                    parentTr.find('input[name="date"]').val('');
                    parentTr.find('input[name="amount"]').val('');
                    parentTr.find('select[name="currency"]').val(1);

                    initEditable();

                } else {
                    btn.closest('tr').find('.editable').editable('hide');
                    btn.hide().siblings('#btn-calendar-edit').show();
                    btn.hide().siblings('#btn-calendar-delete').show();

                    /* currencies */
                    var currencies = getCurrencies();
                    var spanType = btn.closest('tr').find('span[data-name="currency"]');
                    spanType.data('value', data.currency);
                    spanType.text(currencies[data.currency]);

                    /* date */
                    var spanDate = btn.closest('tr').find('span[data-name="date"]');
                    spanDate.data('value', data.date);
                    spanDate.text(data.date);
                    spanDate.show();

                    /* amount */
                    var spanAmount = btn.closest('tr').find('span[data-name="amount"]');
                    spanAmount.data('value', data.name);
                    spanAmount.text(data.name);

                    btn.closest('tr').find('input[name="date"]').remove();

                }

            }
        });
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

function initDatapicker() {

    $('.bs-datepicker').datepicker({
        format: "yyyy-mm-dd",
        weekStart: 1,
        autoclose: true
    });
}

function initEditable() {
    var currencies = [];

    var defaults = {
        mode: 'inline',
        toggle: 'manual',
        inputclass: 'form-control input-sm',
        showbuttons: false,
        onblur: 'ignore',
        savenochange: true,
        success: function() {
            return false;
        }
    };

    $.extend($.fn.editable.defaults, defaults);

    $('span[data-name="amount"]').editable({
        placeholder: 'Salary amount',
        emptytext: ''
    });

    $('span[data-name="currency"]').editable({
        type: 'select',
        source: function() {
            if(currencies.length > 0) {
                return currencies;
            }

            var list = getCurrencies();

            $.each(list, function(k, v) {
                currencies.push({value: k, text: v});
            });

            return currencies;
        }
    });

}