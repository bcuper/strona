$(document).ready(function () {

//Walidacja imienia
    $('#imie').on('blur', function () {

        var input = $(this);
        var pattern = /^[A-Z-zóąśłżźćńÓĄŚŁŻŹĆŃ][a-z-zóąśłżźćńÓĄŚŁŻŹĆŃ]{2,20}/;
        var is_name = pattern.test(input.val());
        var name_length = input.val().length;
        if (name_length >= 4 && is_name) {
            $('#divimie').removeClass("has-error").addClass("has-success");
            $('#spanimie').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divimie').removeClass("has-success").addClass("has-error");
            $('#spanimie').removeClass("glyphicon-ok").addClass("glyphicon-remove");
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
            $('#spannazwisko').removeClass("glyphicon-remove").addClass("glyphicon-ok");

        } else {
            $('#divnazwisko').removeClass("has-success").addClass("has-error");
            $('#spannazwisko').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Nazwisko musi musi rozpoczynać się z wielkiej litery i mieć więcej niż 4 znaki!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja login
    $('#login').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 5) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkusername', zmienna: $("#login").val()},
                type: "POST",
                success: function (data) {

                    if (data == 0) {
                        $('#divlogin').removeClass("has-success").addClass("has-error");
                        $('#spanlogin').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Login jest zajęty. Wpisz inny.").removeClass("text-success").addClass("error");
                    }
                    if (data == 1) {
                        $('#divlogin').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                        $('#spanlogin').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                    }
                },
                error: function () {}
            });
        } else {
            $('#divlogin').removeClass("has-success").addClass("has-error");
            $('#spanlogin').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Login musi mieć więcej niż 4 znaki!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja loginlog
    $('#loginlog').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 5) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkusernamelog', zmienna: $("#loginlog").val()},
                type: "POST",
                success: function (data) {

                    if (data == 1) {
                        $('#divloginlog').removeClass("has-success").addClass("has-error");
                        $('#spanloginlog').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Nie istnieje uzytkownik o podamym loginie").removeClass("text-success").addClass("error");
                    }
                    if (data == 0) {
                        $('#divloginlog').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                        $('#spanloginlog').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                    }
                },
                error: function () {}
            });
        } else {
            $('#divloginlog').removeClass("has-success").addClass("has-error");
            $('#spanloginlog').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Login musi mieć więcej niż 4 znaki!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja loginres
    $('#loginres').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 5) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkusernamelog', zmienna: $("#loginres").val()},
                type: "POST",
                success: function (data) {

                    if (data == 1) {
                        $('#divloginres').removeClass("has-success").addClass("has-error");
                        $('#spanloginres').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Nie istnieje uzytkownik o podamym loginie").removeClass("text-success").addClass("error");
                    }
                    if (data == 0) {
                        $('#divloginres').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                        $('#spanloginres').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                    }
                },
                error: function () {}
            });
        } else {
            $('#divloginres').removeClass("has-success").addClass("has-error");
            $('#spanloginres').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Login musi mieć więcej niż 4 znaki!").removeClass("text-success").addClass("error");
        }
    });

    //Walidacja loginu
    $('#loginu').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        var loginuz = document.getElementById('loginuz');
        if (loginuz.value == $("#loginu").val()) {
            $('#divloginu').removeClass("has-error").addClass("has-success");
            $('#spanloginu').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else if (name_length >= 5) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkusername', zmienna: $("#loginu").val()},
                type: "POST",
                success: function (data) {

                    if (data == 0) {
                        $('#divloginu').removeClass("has-success").addClass("has-error");
                        $('#spanloginu').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Login jest zajęty. Wpisz inny.").removeClass("text-success").addClass("error");
                    }
                    if (data == 1) {
                        $('#divloginu').removeClass("has-error").addClass("has-success");
                        $('#spanimie').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                    }
                },
                error: function () {}
            });
        } else {
            $('#divloginu').removeClass("has-success").addClass("has-error");
            $('#spanloginu').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Login musi mieć więcej niż 4 znaki!").removeClass("text-success").addClass("error");
        }
    });


    //Walidacja hasla
    $('#haslo').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 8) {
            $('#divhaslo').removeClass("has-error").addClass("has-success");
            $('#spanhaslo').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslo').removeClass("has-success").addClass("has-error");
            $('#spanhaslo').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Hasło musi mieć więcej niż 8 znaków!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja haslazh
    $('#haslozh').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 8) {
            $('#divhaslozh').removeClass("has-error").addClass("has-success");
            $('#spanhaslozh').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslozh').removeClass("has-success").addClass("has-error");
            $('#spanhaslozh').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Hasło musi mieć więcej niż 8 znaków!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja haslalog
    $('#haslolog').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 8) {
            $('#divhaslolog').removeClass("has-error").addClass("has-success");
            $('#spanhaslolog').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslolog').removeClass("has-success").addClass("has-error");
            $('#spanhaslolog').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Hasło musi mieć więcej niż 8 znaków!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja hasla2
    $('#haslo2').on('blur', function () {
        var input = $(this);
        var pass1 = document.getElementById('haslo');
        var pass2 = document.getElementById('haslo2');
        if (pass1.value == pass2.value) {
            $('#divhaslo2').removeClass("has-error").addClass("has-success");
            $('#spanhaslo2').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslo2').removeClass("has-success").addClass("has-error");
            $('#spanhaslo2').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Hasła się różnią!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja haslanowe
    $('#haslonowe').on('blur', function () {
        var input = $(this);
        var name_length = input.val().length;
        if (name_length >= 8) {
            $('#divhaslonowe').removeClass("has-error").addClass("has-success");
            $('#spanhaslonowe').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslonowe').removeClass("has-success").addClass("has-error");
            $('#spanhaslonowe').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Hasło musi mieć więcej niż 8 znaków!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja haslanowe2
    $('#haslonowe2').on('blur', function () {
        var input = $(this);
        var pass1 = document.getElementById('haslonowe');
        var pass2 = document.getElementById('haslonowe2');
        if (pass1.value == pass2.value) {
            $('#divhaslonowe2').removeClass("has-error").addClass("has-success");
            $('#spanhaslonowe2').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divhaslonowe2').removeClass("has-success").addClass("has-error");
            $('#spanhaslonowe2').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Hasła się różnią!").removeClass("text-success").addClass("error");
        }
    });
    //Walidacja datyur
    $('#dataur').on('blur', function () {
        var input = $(this);
        var pattern = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
        var is_data = pattern.test(input.val());
        if (is_data) {
            $('#divdataur').removeClass("has-error").addClass("has-success");
            $('#spandataur').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else {
            $('#divdataur').removeClass("has-success").addClass("has-error");
            $('#spandataur').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Wprowadź poprawną datę o formacie RRRR-MM-DD!").removeClass("text-success").addClass("error");
        }
    });

    /*$('#dataur').on('blur', function ()
     {
     var allowBlank = true;
     var minYear = 1902;
     var maxYear = (new Date()).getFullYear();
     var field = $(this);
     
     
     // regular expression to match required date format
     re = /^(\d{4})-(\d{1,2})-(\d{1,2})$/;
     
     if (field.val() != '') {
     if (regs = field.val().match(re)) {
     if (regs[3] < 1 || regs[3] > 31) {
     $('#divdataur').removeClass("has-success").addClass("has-error");
     $('#spandataur').removeClass("glyphicon-ok").addClass("glyphicon-remove");
     input.next('.help-block').text("Podano nieprawidłowy dzień").removeClass("text-success").addClass("error");
     
     } else if (regs[2] < 1 || regs[2] > 12) {
     $('#divdataur').removeClass("has-success").addClass("has-error");
     $('#spandataur').removeClass("glyphicon-ok").addClass("glyphicon-remove");
     input.next('.help-block').text("Podano nieprawidłowy miesiąć").removeClass("text-success").addClass("error");
     
     } else if (regs[1] < minYear || regs[1] > maxYear) {
     $('#divdataur').removeClass("has-success").addClass("has-error");
     $('#spandataur').removeClass("glyphicon-ok").addClass("glyphicon-remove");
     input.next('.help-block').text("Podano nieprawidłowy rok").removeClass("text-success").addClass("error");
     
     }
     } else {
     $('#divdataur').removeClass("has-success").addClass("has-error");
     $('#spandataur').removeClass("glyphicon-ok").addClass("glyphicon-remove");
     input.next('.help-block').text("Wprowadź poprawną datę o formacie RRRR-MM-DD!").removeClass("text-success").addClass("error");
     }
     } else if (!allowBlank) {
     $('#divdataur').removeClass("has-success").addClass("has-error");
     $('#spandataur').removeClass("glyphicon-ok").addClass("glyphicon-remove");
     input.next('.help-block').text("Wprowadź poprawną datę o formacie RRRR-MM-DD!").removeClass("text-success").addClass("error");
     }
     
     
     
     $('#divdataur').removeClass("has-error").addClass("has-success");
     $('#spandataur').removeClass("glyphicon-remove").addClass("glyphicon-ok");
     input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
     });*/

    //Walidacja email
    $('#email').on('blur', function () {
        var input = $(this);
        var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var is_email = pattern.test(input.val());
        if (is_email) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkmail', zmienna: $("#email").val()},
                type: "POST",
                success: function (data) {
                    if (data == 0) {
                        $('#divemail').removeClass("has-success").addClass("has-error");
                        $('#spanemail').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Email jest zajęty. Wpisz inny.").removeClass("text-success").addClass("error");
                    }
                    if (data == 1) {
                        $('#divemail').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                        $('#spanemail').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                    }
                },
                error: function () {
                }
            });

        } else {
            $('#divemail').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Wprowadź poprawny email!").removeClass("text-success").addClass("error");
            $('#spanemail').removeClass("glyphicon-ok").addClass("glyphicon-remove");

        }
    });

    //Walidacja emailres
    $('#emailres').on('blur', function () {
        var input = $(this);
        var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var is_email = pattern.test(input.val());
        if (is_email) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkmailres', zmienna: $("#emailres").val()},
                type: "POST",
                success: function (data) {
                    if (data == 1) {
                        $('#divemailres').removeClass("has-success").addClass("has-error");
                        $('#spanemailres').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Nie istnieje użytkownik o podanym adresie mail.").removeClass("text-success").addClass("error");
                    }
                    if (data == 0) {
                        $('#divemailres').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                        $('#spanemailres').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                    }
                },
                error: function () {
                }
            });

        } else {
            $('#divemailres').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Wprowadź poprawny email!").removeClass("text-success").addClass("error");
            $('#spanemailres').removeClass("glyphicon-ok").addClass("glyphicon-remove");

        }
    });
    //Walidacja emaillog
    $('#emaillog').on('blur', function () {
        var input = $(this);
        var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var is_email = pattern.test(input.val());
        if (is_email) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkmaillog', zmienna: $("#emaillog").val()},
                type: "POST",
                success: function (data) {
                    if (data == 1) {
                        $('#divemaillog').removeClass("has-success").addClass("has-error");
                        $('#spanemaillog').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Nie istnieje użytkownik o podanym adresie mail.").removeClass("text-success").addClass("error");
                    }
                    if (data == 0) {
                        $('#divemaillog').removeClass("has-error").addClass("has-success");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                        $('#spanemaillog').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                    }
                },
                error: function () {
                }
            });

        } else {
            $('#divemaillog').removeClass("has-success").addClass("has-error");
            input.next('.help-block').text("Wprowadź poprawny email!").removeClass("text-success").addClass("error");
            $('#spanemaillog').removeClass("glyphicon-ok").addClass("glyphicon-remove");

        }
    });

    //Walidacja emailu
    $('#emailu').on('blur', function () {
        var input = $(this);
        var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        var is_email = pattern.test(input.val());
        var emailuz = document.getElementById('emailuz');
        if (emailuz.value == $("#emailu").val()) {
            $('#divemailu').removeClass("has-error").addClass("has-success");
            $('#spanemailu').removeClass("glyphicon-remove").addClass("glyphicon-ok");
            input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
        } else if (is_email) {
            jQuery.ajax({
                url: "funkcje.php",
                data: {akcja: 'checkmail', zmienna: $("#emailu").val()},
                type: "POST",
                success: function (data) {
                    if (data == 0) {
                        $('#divemailu').removeClass("has-success").addClass("has-error");
                        $('#spanemailu').removeClass("glyphicon-ok").addClass("glyphicon-remove");
                        input.next('.help-block').text("Email jest zajęty. Wpisz inny.").removeClass("text-success").addClass("error");
                    }
                    if (data == 1) {
                        $('#divemailu').removeClass("has-error").addClass("has-success");
                        $('#spanemailu').removeClass("glyphicon-remove").addClass("glyphicon-ok");
                        input.next('.help-block').text("").removeClass("has-error").addClass("text-success");
                    }
                },
                error: function () {
                }
            });
        } else {
            $('#divemailu').removeClass("has-success").addClass("has-error");
            $('#spanemailu').removeClass("glyphicon-ok").addClass("glyphicon-remove");
            input.next('.help-block').text("Wprowadź poprawny email!").removeClass("text-success").addClass("error");
        }

    });

//Walidacja foto
    

    //Po próbie wysłania formularza
    $('#submit button').click(function (event) {
        var imie = $('#divimie');
        var nazwisko = $('#divnazwisko');
        var login = $('#divlogin');
        var loginu = $('#divloginu');
        var loginres = $('#divloginres');
        var haslo = $('#divhaslo');
        var haslo2 = $('#divhaslo2');
        var email = $('#divemail');
        var emailu = $('#divemailu');
        var emailres = $('#divemailres');
        var dataur = $('#divdataur');
        var haslonowe = $('#divhaslonowe');
        var haslonowe2 = $('#divhaslonowe2');
        if (imie.hasClass('has-error') || nazwisko.hasClass('has-error') || login.hasClass('has-error') || loginu.hasClass('has-error') || loginres.hasClass('has-error') || haslo.hasClass('has-error')
                || haslo2.hasClass('has-error') || email.hasClass('has-error') || emailres.hasClass('has-error') || dataur.hasClass('has-error') || emailu.hasClass('has-error')
                || haslonowe.hasClass('has-error') || haslonowe2.hasClass('has-error')) {
            event.preventDefault();
            alert("Uzupełnij poprawnie wszystkie pola!");
        }
    });


    //przycisk rejestracji modal

});

