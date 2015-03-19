$(function() {
    $('#bs-datepicker-component3').datepicker({ format: "yyyy-mm-dd", startView: "decade" });
    $('#bs-datepicker-component').datepicker({ format: "yyyy-mm-dd" });
    $('#bs-datepicker-component2').datepicker({ format: "yyyy-mm-dd" });
    $("#add-employee .form-control[name=phone]").mask("(999)999-99-99");


    // не работает это
    $(".dropzone-box").dropzone({
        url: "/employee/add-photo",
        paramName: "photo", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        maxFiles: 1,
        acceptedFiles: "image/*"
    });

    if ($('#add-employee .form-control[name=id]').length > 0) {
        $('#update-employee-btn').click(updateEmployee);
    } else {
        $('#create-employee-btn').one('click', addEmployee);
    }

    function addEmployee() {
        var data = {};
        $("#add-employee form .form-control").each(function(i, obj) {
            data[obj.name] = $(obj).val();
        });

        $.ajax({
            url: '/employee/create',
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
                    $('#create-employee-btn').one('click', addEmployee);
                }

                if (response.formData['employeeId'] && ($('#add-employee .form-control[name=id]').length == 0)) {
                    $('#create-employee-btn').text('Update');
                    $('#create-employee-btn').unbind( "click").click(updateEmployee);
                    $('#add-employee .form-control[name=surname]').before('<input type="hidden" name="id" value="'+response.formData['employeeId']+'" class="form-control">');
                }
            },
            error: function(response) {
                $('#create-employee-btn').one('click', addEmployee);
                console.log(response);
            }
        });

        return false;
    }

    function updateEmployee() {
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
            },
            error: function(response) {
                console.log(response);
            }
        });

        return false;
    }
});