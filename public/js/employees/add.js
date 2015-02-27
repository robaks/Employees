$(function() {
    $('#create-employee-btn').click(function() {
        $.ajax({
            url: '/employee/save',
            type: 'POST',
            data: {
                name: 'vvv',
                value: 222
            },
            success: function(response) {
                console.log(response);
            },
            error: function(response) {
                alert(response.message);
            }
        });

        return false;
    });
});