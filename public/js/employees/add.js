$(function() {
    $('#bs-datepicker-component3').datepicker({ format: "yyyy-mm-dd", startView: "decade" });
    $('#bs-datepicker-component').datepicker({ format: "yyyy-mm-dd" });
    $('#bs-datepicker-component2').datepicker({ format: "yyyy-mm-dd" });

    $("#dropzonejs-example").dropzone({
        url: "//dummy.html",
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 0.5, // MB

        addRemoveLinks : true,
        dictResponseError: "Can't upload file!",
        autoProcessQueue: false,
        thumbnailWidth: 138,
        thumbnailHeight: 120,

        previewTemplate: '<div class="dz-preview dz-file-preview"><div class="dz-details"><div class="dz-filename"><span data-dz-name></span></div><div class="dz-size">File size: <span data-dz-size></span></div><div class="dz-thumbnail-wrapper"><div class="dz-thumbnail"><img data-dz-thumbnail><span class="dz-nopreview">No preview</span><div class="dz-success-mark"><i class="fa fa-check-circle-o"></i></div><div class="dz-error-mark"><i class="fa fa-times-circle-o"></i></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div></div><div class="progress progress-striped active"><div class="progress-bar progress-bar-success" data-dz-uploadprogress></div></div></div>',

        resize: function(file) {
            var info = { srcX: 0, srcY: 0, srcWidth: file.width, srcHeight: file.height },
                srcRatio = file.width / file.height;
            if (file.height > this.options.thumbnailHeight || file.width > this.options.thumbnailWidth) {
                info.trgHeight = this.options.thumbnailHeight;
                info.trgWidth = info.trgHeight * srcRatio;
                if (info.trgWidth > this.options.thumbnailWidth) {
                    info.trgWidth = this.options.thumbnailWidth;
                    info.trgHeight = info.trgWidth / srcRatio;
                }
            } else {
                info.trgHeight = file.height;
                info.trgWidth = file.width;
            }
            return info;
        }
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