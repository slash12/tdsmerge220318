<?php
  require('../../includes/dbconnect.php');
  $addfabric = $_POST["add_fabric"];
  if(isset($addfabric))
  {
    $sql ="SELECT * FROM tbl_fabric WHERE fabric ='$addfabric';";
    $res_fabric = mysqli_query($dbc, $sql);
    if(mysqli_num_rows($res_fabric) > 0)
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
