<?php
  require('../../includes/dbconnect.php');
  $addbrand = $_POST["add_brand"];
  if(isset($addbrand))
  {
    $sql ="SELECT * FROM brands WHERE title ='$addbrand';";
    $res = mysqli_query($dbc, $sql);
    if(mysqli_num_rows($res) > 0)
    {
      echo "true";
    }
    else
    {
      echo "false";
    }
  }
  else
  {
    echo "qry no run";
  }
?>