$("#sendAuth").on("click", function () {

    let login = $("#login").val();
    let password = $("#password").val();

    $.ajax({
        url: 'core/signin.php',
        type: 'POST',
        cache: false,
        data: {'login': login, 'password': password},
        dataType: 'json',
        success(data) {
            if (data.status) {
                $("#authForm").trigger("reset");
                document.location.href = '../index.php';
            } else {
                if (data.type === 1) {
                    if (data.fields.includes("login")) {
                        $(`input[name="${login}"]`).addClass('error');
                        $('.msg-login-error').removeClass('none').text("Login was more 5 symbols");
                    }
                    if (data.fields.includes("password")) {
                        $(`input[name="${password}"]`).addClass('error');
                        $('.msg-password-error').removeClass('none').text("Password was more 5 symbols and include letters and digits");
                    }
                } else {
                    $('.msg').removeClass('none').text("User was not register");
                }
            }
        }
    });
});