<div id="odprej"></div>
<div>
    <form class="form-horizontal form-group" enctype="multipart/form-data" id="modalform" action="" method="POST">
        
<?php
    $nazwa[0][0] = 'imie';      $nazwa[0][1] = 'imię';              $nazwa[0][2] = 'text';
    $nazwa[1][0] = 'nazwisko';  $nazwa[1][1] = 'nazwisko';          $nazwa[1][2] = 'text';
    $nazwa[2][0] = 'login';     $nazwa[2][1] = 'login';             $nazwa[2][2] = 'text';
    $nazwa[3][0] = 'haslo';     $nazwa[3][1] = 'haslo';             $nazwa[3][2] = 'password';  
    $nazwa[4][0] = 'haslo2';    $nazwa[4][1] = 'ponownie hasło';    $nazwa[4][2] = 'password';
    $nazwa[5][0] = 'email';     $nazwa[5][1] = 'email';             $nazwa[5][2] = 'email';
    $nazwa[6][0] = 'tel';       $nazwa[6][1] = 'nr. telefonu';      $nazwa[6][2] = 'text';

for ($i = 0; $i < 7; $i++) {
        echo '<div id="div' . $nazwa[$i][0] . '" class="form-group has-feedback">';
        echo '<label  class="control-label" for="' . $nazwa[$i][0] . '">Podaj ' . $nazwa[$i][1] . ' :</label>';
    
        echo '<input type="' . $nazwa[$i][2] . '" id="' . $nazwa[$i][0] . '" name="' . $nazwa[$i][0] . '" required="wymagane pole"  class="form-control"></input>';
        echo '<span class="help-block"></span>';
        echo '<span id="span' . $nazwa[$i][0] . '" class="glyphicon form-control-feedback" aria-hidden="true"></span> ';
        echo '</div>';      
    }

?>      
        <div id="divdataur2" class="form-group form-horizontal form-inline">                    
            <label  class="control-label"  for="foto">Podaj datę urodzenia: </label>
            
              <select class="form-control" id="dzien" name="dzien" size="1">
               <?php
               for($i = 1; $i < 32; $i++){
                   echo '<option value="'.$i.'">' . $i . '</option>';
               }
               ?>
            </select> &nbsp;           
            <select class="form-control" id="miesiac" name="miesiac" size="1">
                 <?php
                for($i = 1; $i < 13; $i++){
                                   
                    echo '<option value="'.$i.'">' . $nazwamiesiaca[$i] . '</option>';
                }
                ?>
            </select> &nbsp;
             <select class="form-control" id="rok" name="rok" size="1">
                <?php
                for($i = 1940; $i <= date("Y"); $i++){
                    echo '<option value="'.$i.'">' . $i . '</option>';
                }
                ?>
            </select> &nbsp;
            
          
            <span id="spanfoto" class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <span class="help-block"></span>
        </div>
       
        <div id="divfoto" class="form-group form-horizontal">                    
            <label  class="control-label"  for="foto">Wybierz plik</label>

            <input name="foto" type="file" id="foto" accept="image/*">
            <span id="spanfoto" class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <span class="help-block"></span>
        </div>
    </form>
</div>
<div> 
    <button id="rejbtn" class="modal-btn-login btn btn-success btn-block">Zarejestruj się</button>             
</div>           
