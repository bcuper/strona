<div id="odprej"></div>
<div><form class="form-horizontal form-group" enctype="multipart/form-data" id="modalform" action="" method="POST">

        <div id="divimie" class="form-group has-feedback">                    
            <label  class="control-label" for="imie">Imię:</label>

            <input type="text" id="imie" name="imie" required  class="form-control"></input>
            <span class="help-block"></span>
            <span id="spanimie" class="glyphicon form-control-feedback" aria-hidden="true"></span>   
        </div>

        <div id="divnazwisko" class="form-group has-feedback">
            <label class="control-label" for="nazwisko">Nazwisko:</label>
            <input type="text" class="form-control" id="nazwisko" name="nazwisko" required></input>
            <span class="help-block"></span>
           <span id="spannazwisko" class="glyphicon form-control-feedback" aria-hidden="true"></span>  

        </div>

        <div id="divlogin"class="form-group has-feedback">
            <label class="control-label" for="login">Login:</label>
            <input type="text" class="form-control" id="login" name="login" required></input>
            <span class="help-block"></span>
            <span id="spanlogin" class="glyphicon form-control-feedback" aria-hidden="true"></span>                

        </div>

        <div id="divhaslo" class="form-group has-feedback">
            <label class="control-label" for="haslo">Hasło:</label>

            <input type="password" class="form-control" id="haslo" name="haslo" required></input>
            <span class="help-block"></span>
            <span id="spanhaslo" class="glyphicon form-control-feedback" aria-hidden="true"></span>

        </div>

        <div id="divhaslo2" class="form-group has-feedback">
            <label class="control-label" for="haslo2">Powtórz hasło:</label>

            <input type="password" class="form-control" id="haslo2" name="haslo2" required></input>
            <span class="help-block"></span>
            <span id="spanhaslo2" class="glyphicon form-control-feedback" aria-hidden="true"></span>

        </div>

        <div id="divdataur" class="form-group has-feedback">
            <label class="control-label" for="dataur">Data urodzenia:</label>

            <input type="date" class="form-control" id="dataur" name="dataur" max="<?php echo date("Y.m.d"); ?>" required placeholder="RRRR-MM-DD"></input>
            <span class="help-block"></span>
            <span id="spandataur" class="glyphicon form-control-feedback" aria-hidden="true"></span>

        </div>

        <div id="divemail" class="form-group has-feedback">
            <label class="control-label" for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required></input>
            <span class="help-block"></span>
            <span id="spanemail" class="glyphicon form-control-feedback" aria-hidden="true"></span>
        </div> 
        
        <div id="divuserfile" class="form-group form-horizontal">                    
            <label  class="control-label col-sm-4" for="foto">Wybierz plik</label>
            <div class="col-md-4">            
                <input name="foto" type="file" id="foto">
               
                <span class="help-block"></span>

            </div>
        </div>



    </form>
</div>
<div> 
    <button id="rejbtn" class="modal-btn-login btn btn-success btn-block">Zarejestruj się</button>             
</div>               


<script>
    $(document).ready(function () {
        $('#rejbtn').on('click', function (event) {
            var imie = $('#divimie');
            var nazwisko = $('#divnazwisko');
            var login = $('#divlogin');
            var haslo = $('#divhaslo');
            var haslo2 = $('#divhaslo2');
            var email = $('#divemail');
            var dataur = $('#divdataur');

            if (!imie.hasClass('has-success') || !nazwisko.hasClass('has-success') || !login.hasClass('has-success') || !haslo.hasClass('has-success')
                    || !haslo2.hasClass('has-success') || !email.hasClass('has-success') || !dataur.hasClass('has-success')) {
                event.preventDefault();
                alert("Uzupełnij poprawnie wszystkie pola!");
            } else {
                   var postData = new FormData($("#modalform")[0]);

                         $.ajax({
                                 type:'POST',
                                 url:'rejestracjamodal1.php',
                                 processData: false,
                                 contentType: false,
                                 data : postData,
                                 success:function(data){
                                   $('#odprej').append(data);
                                 }

                              });
               
            }
        });
    });

</script>

