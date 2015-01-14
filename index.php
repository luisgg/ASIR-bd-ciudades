<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Base Datos Ciudades</title>
    </head>
    <body>
        <?php
        // put your code here
         require 'config.php';
         $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
         mysqli_select_db($link, $DB_NAME);
         $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
         $lista = mysqli_query($link, "SELECT * FROM `ciudades`");
         $numfilas = mysqli_num_rows($lista);
         echo "La consulta ha devuelto ".$numfilas. " filas<br>";
         $filaspagina = 2;
         mysqli_data_seek($lista, 0);
         $sigue = True;
         $n = 0;
         while ($sigue) {
             $ciudad= mysqli_fetch_array($lista);
             if ($ciudad) {
                 echo $ciudad['id'];
                 echo "<br>";
                 echo $ciudad['ciudad'];
                 echo "<br>";
                 $n++;
             } else {
                 $sigue = False;
             }
             if ($n == $filaspagina) {
                 echo "<hr>";
                 $n = 0;
             }
         }
         
         mysqli_close($link);
        ?>
    </body>
</html>
