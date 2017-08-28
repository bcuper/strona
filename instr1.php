<html lang="PL">
<?php
echo date("m");

echo date("Y-m-M");
echo'<br>';
$a = cal_to_jd(CAL_GREGORIAN, '6', '26', '2017');
        $b = date_format($a, "Y-m-d");
        echo $b;
        echo date_sunrise("02-02-2017");
?>
</html>