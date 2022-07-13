$(function() {
    $("#error-msg").hide(); 
    $('#login').click(function(e) {

        let self = $(this);

        e.preventDefault(); // prevent default submit behavior

        self.prop('disabled', true);

        var data = $('#login-form').serialize(); // get form data

        // sending ajax request to login.php file, it will process login request and give response.
        $.ajax({
            url: 'controller/login',
            type: "POST",
            data: data,
        }).done(function(res) {
            res = JSON.parse(res);
            if (res['status']) // if login successful redirect user to specified page.
            {
                var redirection = res['redirect'];
                location.href = redirection; 

            } else {

                var errorMessage = '';
                // if there is any errors convert array of errors into html string, 
                //here we are wrapping errors into a paragraph tag.
                console.log(res.msg);
                $.each(res['msg'], function(index, message) {
                    errorMessage += '<div>' + message + '</div>';
                });
                // place the errors inside the div#error-msg.
                $("#error-msg").html(errorMessage);
                $("#error-msg").show(); // show it on the browser, default state, hide
                // remove disable attribute to the login button, 
                //to prevent multiple form submissions 
                //we have added this attribution on login from submit
                self.prop('disabled', false);
            }
        }).fail(function() {
            alert("error");
        }).always(function() {
            self.prop('disabled', false);
        });
    });
});