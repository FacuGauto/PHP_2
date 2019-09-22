<?php
  $x = $_GET['x'];
  $y = $_GET['y'];
  $resultado = $x + $y;

  echo "La variable x tiene el valor: " . $x . " y la variable y tiene el valor: " . $y . "<br/>";
  echo "La suma de las dos variables es: " . $resultado;

  $sum = 0;
  for($i=1;$sum <1000; $i++)
  {
      $sum = $sum + $i;
      echo $sum . "<br/>";
  }

  echo "La suma da: " . $sum;
  echo "La cantidad de numeros sumados es: " . $i;
?>