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
        // funciones del programa
        function muestraciudades($inicial,$filaspagina){
            require 'config.php';
            $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD);
            mysqli_select_db($link, $DB_NAME);
            $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes
            $lista = mysqli_query($link, "SELECT * FROM `ciudades`");
            $numfilas = mysqli_num_rows($lista);
            mysqli_data_seek($lista, $inicial);
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
                    $sigue = False;
                    $n = 0;
                }
            }

            mysqli_close($link);
            return $numfilas;
        }
        
        // Programa principal
        if (isset($_REQUEST['primerafila'])) {
            $primerafila=$_REQUEST['primerafila'];
        } else {
            $primerafila = 0;
        }
        echo "<br>";
        $filaspagina = 2;
        $totalfilas = muestraciudades($primerafila,$filaspagina);
        $filaanterior = $primerafila - $filaspagina;
        $filasiguiente = $primerafila + $filaspagina;
        echo "<br>";
        echo "<a href='index.php?primerafila=".$filaanterior."'>anterior</a>";
        echo "<br>";
        echo "<a href='index.php?primerafila=".$filasiguiente."'>siguiente</a>";

        ?>
    </body>
</html>
