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
                $("#add-employee form .form-control").each(function(i, obj) {
                    var $parent = $(obj).closest('.form-group');
                    $parent.removeClass('has-error');
                    $parent.find('p.help-block').remove();
                });

                if (response.errors) {
                    $.each(response.errors, function (field, errors) {
                        var $parent = $('.form-control[name=' + field + ']').closest('.form-group');

                        $parent.addClass('has-error');

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