$().ready(function() {
    alert("asdasd");
    $('#signupForm').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            name: "Fill name",
            password: {
                required: "Fill the password",
                minlength: "Your password must be of minimum 5 charaters long"
            }
        }
    });

    $("#submit").click(function() {
        $('#div').hide();
    });


    /*$('#signupForm').on('click', '#submit', function(e) {

    });*/
});