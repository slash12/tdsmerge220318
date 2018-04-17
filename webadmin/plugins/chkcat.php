<?php
  require('../../includes/dbconnect.php');
  $addcat = $_POST["add_cat"];
  if(isset($addcat))
  {
    $sql ="SELECT * FROM category WHERE title ='$addcat';";
    $res_cat = mysqli_query($dbc, $sql);
    if(mysqli_num_rows($res_cat) > 0)
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
