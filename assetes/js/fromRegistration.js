$("#sendRegistration").on("click", function(){
    let regexFromPassword = /(^\w{6,}$)/gm;
    let regexFromEmail = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
    var login = $("#login").val();
    let password = $("#password").val();
    let confirmPassword = $("#confirm-password").val();
    let email = $("#email").val();
    let name = $("#name").val().trim();

    $.ajax({
        url: '../core/signup.php',
        type: 'POST',
        cache: false,
        data: {'login': login, 'password': password, 'confirmPassword': confirmPassword ,'email': email, 'name': name},
        dataType: 'json',
        success (data) {
            if (data.status) {
                $("#registrationForm").trigger("reset");
                document.location.href = '../index.php';
            } else {
                if (data.type === 1) {
                    if(data.fields.includes("login")){
                        $(`input[name="${login}"]`).addClass('error');
                        $('.msg-login-error').removeClass('none').text("Login was more 5 symbols");
                    }
                    if(data.fields.includes("password")){
                        $(`input[name="${password}"]`).addClass('error');
                        $('.msg-password-error').removeClass('none').text("Password was more 5 symbols and include letters and digits");
                    }
                    if(data.fields.includes("confirmPassword")){
                        $(`input[name="${password}"]`).addClass('error');
                        $(`input[name="${confirm-Password}"]`).addClass('error');
                        $('.msg-password-error').removeClass('none').text("Passwords was not equals");
                        $('.msg-confirm-password-error').removeClass('none').text("Passwords was not equals");
                    }
                    if(data.fields.includes("email")){
                        $(`input[name="${email}"]`).addClass('error');
                        $('.msg-email-error').removeClass('none').text("Email invalid");
                    }
                    if(data.fields.includes("name")){
                        $(`input[name="${name}"]`).addClass('error');
                        $('.msg-name-error').removeClass('none').text("Name was more 2 symbols ");
                    }

                } else if (data.type === 2){
                    if(data.fields.includes("login")){
                        $(`input[name="${login}"]`).addClass('error');
                        $('.msg-login-error').removeClass('none').text("Login was exists");
                    }
                    if(data.fields.includes("email")){
                        $(`input[name="${email}"]`).addClass('error');
                        $('.msg-email-error').removeClass('none').text("Email was exists");
                    }
                } else {
                    $('.msg').removeClass('none').text("User was not register");
                }
            }
        }
    });
});