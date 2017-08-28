$(document).ready(function () {

//Walidacja imienia
    $('#imie').on('blur', function () {

        var input = $(this);
        var pattern = /^[A-Z-zóąśłżźćńÓĄŚŁŻŹĆŃ][a-z-zóąśłżźćńÓĄŚŁŻŹĆŃ]{2,20}/;
        var is_name = pattern.test(input.val());
        var name_length = input.val().length;
        if (name_length >= 4 && is_name) {
            $('#divimie').removeClass("has-error").addClass("has-success");

            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divimie').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Imie musi rozpoczynać się z wielkiej litery i mieć więcej niż 4 znaki!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja nazwiska
    $('#nazwisko').on('blur', function () {
        var input = $(this);
        var pattern = /^[A-Z-zóąśłżźćńÓĄŚŁŻŹĆŃ][a-z-zóąśłżźćńÓĄŚŁŻŹĆŃ]{2,20}/;
        var is_name = pattern.test(input.val());
        var name_length = input.val().length;
        if (name_length >= 4 && is_name) {
            $('#divnazwisko').removeClass("has-error").addClass("has-success");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");

        } else {
            $('#divnazwisko').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Nazwisko musi musi rozpoczynać się z wielkiej litery i mieć więcej niż 4 znaki!").removeClass("text-success").addClass("blad");
        }
    });
    //Walidacja loginu
    $('#login').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 5) {
            jQuery.ajax({
                url: "check_username.php",
                data: 'login=' + $("#login").val(),
                type: "POST",
                success: function (data) {

                    if (data == 0) {
                        $('#divlogin').removeClass("has-success").addClass("has-error");
                        input.next('.help-block').text("Login jest zajęty. Wpisz inny.").removeClass("text-success").addClass("blad");
                    }
                    if (data == 1) {
                        $('#divlogin').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                    }
                },
                error: function () {}
            });
        } else {
            $('#divlogin').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Login musi mieć więcej niż 4 znaki!").removeClass("text-success").addClass("blad");
        }
    });
    //Walidacja hasla
    $('#haslo').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 8) {
            $('#divhaslo').removeClass("has-error").addClass("has-success");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslo').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Hasło musi mieć więcej niż 8 znaków!").removeClass("text-success").addClass("blad");
        }
    });
    //Walidacja hasla2
    $('#haslo2').on('blur', function () {
        var input = $(this);
        var pass1 = document.getElementById('haslo');
        var pass2 = document.getElementById('haslo2');
        if (pass1.value == pass2.value) {
            $('#divhaslo2').removeClass("has-error").addClass("has-success");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslo2').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Hasła się różnią!").removeClass("text-success").addClass("blad");
        }
    });
    //Walidacja datyur
    $('#dataur').on('blur', function () {
        var input = $(this);
        var pattern = /^(\d{4})-(\d{1,2})-(\d{1,2})/;
        var is_data = pattern.test(input.val());
        if (is_data) {
            $('#divdataur').removeClass("has-error").addClass("has-success");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divdataur').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Wprowadź poprawną datę o formacie RRRR-MM-DD!").removeClass("text-success").addClass("blad");
        }
    });
    //Walidacja email
    $('#email').on('blur', function () {
        var input = $(this);
        var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var is_email = pattern.test(input.val());
        if (is_email) {
            jQuery.ajax({
                url: "check_email.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function (data) {
                    if (data == 0) {
                        $('#divemail').removeClass("has-success").addClass("has-error");
                        input.next('.help-block').text("Email jest zajęty. Wpisz inny.").removeClass("text-success").addClass("blad");
                    }
                    if (data == 1) {
                        $('#divemail').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                    }
                },
                error: function () {
                }
            });

        } else {
            $('#divemail').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Wprowadź poprawny email!").removeClass("text-success").addClass("blad");
        }
    });
    //Po próbie wysłania formularza
    $('#submit button').click(function (event) {
        var imie = $('#imie');
        var nazwisko = $('#nazwisko');
        var login = $('#login');
        var haslo = $('#haslo');
        var haslo2 = $('#haslo2');
        var email = $('#email');
        var dataur = $('#dataur');
        if (!imie.hasClass('valid') || !nazwisko.hasClass('valid') || !login.hasClass('valid') || !haslo.hasClass('valid')
                || !haslo2.hasClass('valid') || !email.hasClass('valid') || !dataur.hasClass('valid')) {
            event.preventDefault();
            alert("Uzupełnij poprawnie wszystkie pola!");
        }
    });
});
