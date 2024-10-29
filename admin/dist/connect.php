<?php
  $con = mysqli_connect("localhost","root","","orebank_db");

  if ($con)
  {
    // echo "Done";
  }
  else
  {
    echo "Conncetion Not Connect";
  }
?>