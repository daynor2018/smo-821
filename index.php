<!DOCTYPE HTML>
<html lang="es-ES">
<head>
  <meta charset="UTF-8">
  <title>Practica SMO-821</title>
</head>
<body>
<h2>TRANSFORMADA INVERSA</h2>
<form action="index.php" method="POST">
  <label>Ingrese el conjunto de datos empiricos adquiridos(Cada espacio da lugar a un nuevo dato):</label>
  <br><br>
  <input type="text" name="datos" required>
  <br><br>
  <label>¿Cuantas pruebas necesita realizar?</label>
  <br><br>
  <input type="text" name="pruebas" required>
  <input type="submit" value="Verificar">
</form>
</body>
</html>

<?php
  error_reporting(0);
  if($_POST){
    echo "<input name='Button' type='button' class='t_n' class='cajas' onClick='javascript:window.history.back()' value='Atras'> 
      <br>
      <br>";
    $numeros = explode(" ", $_POST['datos']);
    $cantidad = count($numeros);
    echo "RESULTADOS:";
    $bandera=0;
    for ($i=0; $i < $cantidad ; $i++) { 
      if (!is_numeric($numeros[$i])) {
        $bandera=1;
      }
    }

    if ($bandera==0) {
      for ($i=0; $i < $cantidad-1; $i++) { 
        for ($j=$i+1; $j <= $cantidad-1; $j++) { 
          if ($numeros[$i]>$numeros[$j]) {
            $aux=$numeros[$i];
            $numeros[$i]=$numeros[$j];
            $numeros[$j]=$aux;
          }
        }
      }
      echo "<br><br>";
      echo "ordenados";
      print_r($numeros);
      echo "<br><br>";
      echo "cantidad".$cantidad;
      echo "<br><br>";
      $c=0;

      for ($i=0; $i < $cantidad; $i++) { 
        $sw=0;
        $aumento=1;
        $x[$c]=$numeros[$i];
        while ( $sw == 0 && $i < $cantidad-1) {
            if ($numeros[$i]==$numeros[$i+$aumento])
            {
              $aumento=$aumento+1;
            }else{
              $sw=1;
              $i=$i+($aumento-1);
            }
          
        }
        $fi[$c]=$aumento;
        $c=$c+1;
      }
      echo "x:";
      print_r($x);
      echo "<br><br>";
      echo "fi:";
      print_r($fi);
      echo "<br><br>";
      echo "c:";
      print_r($c);
      echo "<br><br>";
      $sumapi=0;
      for ($i=0; $i < $c; $i++) { 
        $d=$fi[$i]/$cantidad;
        $pi[$i]=round( $d, 2, PHP_ROUND_HALF_UP);
        $sumapi=$sumapi+$pi[$i];
      }

      echo "pi: ";
      print_r($pi);
      echo "<br><br>";
      echo "suma de pi: ".$sumapi;
      echo "<br><br>";
      if ($sumapi>1) {
        $vueltas=$sumapi-1;
        $paso=1;
        $vueltas=$vueltas*100;
      }else{
        if ($sumapi<1) {
          $vueltas=1-$sumapi;  
          $paso=2;
          $vueltas=$vueltas*100;
        }else{
          $paso=0;
        }        
      }

      echo "vueltas: ".$vueltas;
      echo "<br><br>";

      if ($paso!=0) {
        for ($k=0; $k < $vueltas-1; $k++)
        {
          $menor=0;
          for ($i=1; $i < $c; $i++) { 
            if ($pi[$menor]>$pi[$i]) {
              $menor=$i;
            }
          }
          if ($paso==1) {
            $pi[$menor]=$pi[$menor]-0.01;
            $sumapi=$sumapi-0.01;
          }
          if ($paso==2) {
            $pi[$menor]=$pi[$menor]+0.01;
            $sumapi=$sumapi+0.01; 
          }
        }  
      }
      
      $pia[0]=$pi[0];
      for ($i=1; $i < $c; $i++) { 
        $pia[$i]=$pia[$i-1]+$pi[$i];
      }
      echo "pi: ";
      print_r($pi);
      echo "<br><br>";
      echo "pia: ";
      print_r($pia);
      echo "<br><br>";

      $pa[0]=0;
      for ($i=0; $i < $c-1; $i++) { 
        $pa[$i+1]=$pia[$i];
      }

      echo "pa: ";
      print_r($pa);
      echo "<br><br>";

      $numaleatorio=$_POST['pruebas'];
      echo "pruebas: ";
      print_r($numaleatorio);
      echo "<br><br>";

      for ($i=0; $i < $numaleatorio; $i++) { 
         $randomFloat = rand(0, 100) / 100;
         $aleatorio[$i]=$randomFloat;
        }

      echo "numeros_aleatorios: ";
      print_r($aleatorio);
      echo "<br><br>";

      for ($j=0; $j < $c; $j++) { 
          echo $pa[$j];
          echo " -U- ".$pia[$j];
          echo " -- ".$x[$j];
          echo "<br><br>";
        }

      for ($i=0; $i < $numaleatorio; $i++) { 
        $xo=0;
        $l=0;
        while ($xo==0) {
          if ($aleatorio[$i]>$pa[$l]) {
            if ($aleatorio[$i]<=$pia[$l]) {
              $segx[$i]=$x[$l];
              $xo=1;
            }
          }
          $l=$l+1;
        }
      }

      echo "x seg: ";
      print_r($segx);
      echo "<br><br>";

      for ($i=0; $i < $numaleatorio-1; $i++) { 
        for ($j=$i+1; $j <= $numaleatorio-1; $j++) { 
          if ($segx[$i]>$segx[$j]) {
            $aux=$segx[$i];
            $segx[$i]=$segx[$j];
            $segx[$j]=$aux;
          }
        }
      }

      echo "x seg ordenado: ";
      print_r($segx);
      echo "<br><br>";
      $cseg=0;
      for ($i=0; $i < $numaleatorio; $i++) { 
        $sw=0;
        $aumento=1;
        $va[$cseg]=$segx[$i];
        while ( $sw == 0 && $i < $numaleatorio-1) {
            if ($segx[$i]==$segx[$i+$aumento])
            {
              $aumento=$aumento+1;
            }else{
              $sw=1;
              $i=$i+($aumento-1);
            }
        }
        $fiseg[$cseg]=$aumento;
        $cseg=$cseg+1;
      }
      echo "va:";
      print_r($va);
      echo "<br><br>";
      echo "fi:";
      print_r($fiseg);
      echo "<br><br>";
      echo "cseg:";
      print_r($cseg);
      echo "<br><br>";

      $sumaseg=0;
      for ($i=0; $i < $cseg; $i++) { 
        $di=$fiseg[$i]/$numaleatorio;
        $piseg[$i]=round( $di, 2, PHP_ROUND_HALF_UP);
        $sumaseg=$sumaseg+$piseg[$i];
      }

      echo "piseg: ";
      print_r($piseg);
      echo "<br><br>";
      echo "suma de piseg: ".$sumaseg;
      echo "<br><br>";

      if ($sumaseg>1) {
        $vueltasseg=$sumaseg-1;
        $pasoseg=1;
        $vueltasseg=$vueltasseg*100;
      }else{
        if ($sumaseg<1) {
          $vueltasseg=1-$sumaseg;  
          $pasoseg=2;
          $vueltasseg=$vueltasseg*100;
        }else{
          $pasoseg=0;
        }        
      }

      echo "vueltas seg: ".$vueltasseg;
      echo "<br><br>";

      if ($pasoseg!=0) {
        for ($k=0; $k < $vueltasseg-1; $k++)
        {
          $menorseg=0;
          for ($i=1; $i < $cseg; $i++) { 
            if ($piseg[$menorseg]>$piseg[$i]) {
              $menorseg=$i;
            }
          }
          if ($pasoseg==1) {
            $piseg[$menorseg]=$piseg[$menorseg]-0.01;
            $sumaseg=$sumaseg-0.01;
          }
          if ($pasoseg==2) {
            $piseg[$menorseg]=$piseg[$menorseg]+0.01;
            $sumaseg=$sumaseg+0.01; 
          }
        }  
      }

      echo "nuevo piseg: ";
      print_r($piseg);
      echo "<br><br>";
      echo "sumaseg: ";
      print_r($sumaseg);
      echo "<br><br>";

      $esperanza=0;
      for ($i=0; $i < $cseg; $i++) { 
        $esperanza=$esperanza+($va[$i]*$piseg[$i]);
      }
      echo "esperanza: ";
      print_r($esperanza);
      echo "<br><br>";
      $esperanza2=0;
      for ($i=0; $i < $cseg; $i++) { 
        $esperanza2=$esperanza2+(pow($va[$i], 2)*$piseg[$i]);
      }
      echo "esperanza2: ";
      print_r($esperanza2);
      echo "<br><br>";
      $varianza=$esperanza2-(pow($esperanza, 2));
      $varianza=round( $varianza, 2, PHP_ROUND_HALF_UP);
      echo "varianza: ";
      print_r($varianza);
      echo "<br><br>";
      $rror=sqrt($varianza);
      $rror=round( $rror, 2, PHP_ROUND_HALF_UP);
      echo "error: ";
      print_r($rror);
      echo "<br><br>";
    }else{
      echo "*No se ha ingresado una linea de datos de la manera correcta.";
    }
  }
?>

