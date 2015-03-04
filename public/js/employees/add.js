$(function() {
    $('#bs-datepicker-component3').datepicker({ format: "yyyy-mm-dd", startView: "decade" });
    $('#bs-datepicker-component').datepicker({ format: "yyyy-mm-dd" });
    $('#bs-datepicker-component2').datepicker({ format: "yyyy-mm-dd" });


    // не работает это
    $(".dropzone-box").dropzone({
        url: "/employee/add-photo",
        paramName: "photo", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        maxFiles: 1,
        acceptedFiles: "image/*"
    });

    $('#create-employee-btn').one('click', function() {
        var data = {};
        $("#add-employee form .form-control").each(function(i, obj) {
            data[obj.name] = $(obj).val();
        });

        $.ajax({
            url: '/employee/save',
            type: 'POST',
            data: data,
            success: function(response) {
                if (response.errors) {
                    $.each(response.errors, function (field, errors) {
                        var $parent = $('input[name=' + field + ']').parent();
                        $parent.removeClass('has-error');
                        $parent.addClass('has-error');

                        $parent.find('p.help-block').remove();
                        $.each(errors, function (key, error) {
                            $parent.append('<p class="help-block">' + error + '</p>');
                        });
                    });
                }
                //console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    });
});