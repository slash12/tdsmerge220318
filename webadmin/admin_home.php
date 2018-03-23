<?php require("no_redirect.php");
// require("../includes/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ShirtPrints - T-Shirt Form</title>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.form.js"></script>
    <link href="../css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

  </head>
  <body>
    <?php require('../includes/admin_navbar.php'); ?>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link  active"  id="add_tshirt-tab" data-toggle="tab" href="#add_tshirt" role="tab" aria-controls="add_tshirt" aria-selected="true">Add</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="modify_tshirt-tab" data-toggle="tab" href="#modify_tshirt" role="tab" aria-controls="modify_tshirt" aria-selected="false">Modify</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="remove_tshirt-tab" data-toggle="tab" href="#remove_tshirt" role="tab" aria-controls="remove_tshirt" aria-selected="false">Remove</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="view_tshirt-tab" data-toggle="tab" href="#view_tshirt" role="tab" aria-controls="view_tshirt" aria-selected="false">View</a>
        </li>
      </ul>
    <div class="tab-content" id="myTabContent">

      <?php
        if(isset($_POST['btnsubas']))
        {
          $arr_err = array();

          //Brand Validation
          $brand_cc = $_POST['sltbrand'];
          if($brand_cc == "0")
          {
            $arr_err[] = "Please choose a brandname";
            $brand_err = "Please choose a brandname";
          }
          else
          {
            $brand = mysqli_real_escape_string($dbc, $brand_cc);
          }

          // Category Validation
          $cat_cc = $_POST['sltcat'];
          if($cat_cc == "0")
          {
            $arr_err[] = "Please choose a category";
            $cat_err = "Please choose a category";
          }
          else
          {
            $category = mysqli_real_escape_string($dbc, $cat_cc);
          }

          //color T-Shrit front-size
          $colorfront = mysqli_real_escape_string($dbc, $_POST["txtfcolor"]);

          //color T-Shrit front-size
          $colorback = mysqli_real_escape_string($dbc, $_POST["txtbcolor"]);;


          // Design title Validation
          $design_cc = trim($_POST['txtdesign']);
          if(empty($design_cc))
          {
            $arr_err[] = "Please enter a design title";
            $design_err = "Please enter a design title";
          }
          else
          {
            $design = mysqli_real_escape_string($dbc, $design_cc);
          }

          // Features Validation
          $features_cc = $_POST['sltcat'];
          if($features_cc == "0")
          {
            $arr_err[] = "Please choose a features";
            $features_err = "Please choose a features";
          }
          else
          {
            $features = mysqli_real_escape_string($dbc, $features_cc);
          }

          // Fabric Validation
          $fabric_cc = $_POST['sltfabric'];
          if($fabric_cc == "0")
          {
            $arr_err[] = "Please choose a fabric";
            $fabric_err = "Please choose a fabric";
          }
          else
          {
            $fabric = mysqli_real_escape_string($dbc, $fabric_cc);
          }

          // Type Validation
          $type_cc = $_POST['sltfabric'];
          if($type_cc == "0")
          {
            $arr_err[] = "Please choose a type";
            $type_err = "Please choose a type";
          }
          else
          {
            $type = mysqli_real_escape_string($dbc, $type_cc);
          }

          if ($_FILES['uplfimg']['error'][0] === 0)
          {
            //Image Front Validation
            $uploadfile=$_FILES["uplfimg"]["tmp_name"];
            $folder="../images/tshirt/";
            $target_file = $folder.basename($_FILES["uplfimg"]["name"][0]);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            //Size Validation(>500 kb denied)
           if ($_FILES["uplfimg"]["size"][0] > 500000)
            {
              $img_f_err = "Sorry, your file is too large.";
              $arr_err[] = "Sorry, your file is too large.";
            }
          }
          else
          {
            echo "<script>alert('Error Uploading Image Front: ".$_FILES['uplbimg']['error'][0]."');</script>";
          }

          if ($_FILES['uplbimg']['error'][0] === 0)
          {
            //Image Back Validation
            $uploadfile1=$_FILES["uplbimg"]["tmp_name"];
            $folder1="../images/tshirt/";
            $target_file1 = $folder1.basename($_FILES["uplbimg"]["name"][0]);
            $imageFileType1 = pathinfo($target_file1, PATHINFO_EXTENSION);

            //Size Validation(>500 kb denied)
            if ($_FILES["uplbimg"]["size"][0] > 500000)
            {
              //echo $_FILES["uplbimg"]["size"][0];
              $img_b_err = "Sorry, your file is too large.";
              $arr_err[] = "Sorry, your file is too large.";
            }
          }
          else
          {
            echo "<script>alert('Error Uploading Image Back: ".$_FILES['uplbimg']['error'][0]."');</script>";
          }

          // Pattern Validation
          $pattern_cc = trim($_POST['txtpat']);
          if(empty($pattern_cc))
          {
            $arr_err[] = "Please enter a pattern";
            $pattern_err = "Please enter a pattern";
          }
          else
          {
            $pattern = mysqli_real_escape_string($dbc, $pattern_cc);
          }

          // Price Validation
          $price_cc = trim($_POST['txtprice']);
          if(empty($price_cc))
          {
            $arr_err[] = "Please enter a Price";
            $price_err = "Please enter a Price";
          }
          elseif(!preg_match("/[0-9]+/", $price_cc))
          {
            $arr_err[] = "Please enter an appropriate value";
            $price_err = "Please enter an appropriate value";
          }
          else
          {
            $price = mysqli_real_escape_string($dbc, $price_cc);
          }

          // Size Validation
          $size_cc = $_POST['sltsize'];
          if($size_cc == "0")
          {
            $arr_err[] = "Please choose a size";
            $size_err = "Please choose a size";
          }
          else
          {
            $size = mysqli_real_escape_string($dbc, $size_cc);
          }

          // Quantity Validation
          $qty_cc = trim($_POST['txtqty']);
          if(empty($qty_cc))
          {
            $arr_err[] = "Please enter a quantity value";
            $qty_err = "Please enter a quantity value";
          }
          elseif(!preg_match("/[1-9]+/", $qty_cc))
          {
            $arr_err[] = "Please enter an appropriate quantity value";
            $qty_err = "Please enter an appropriate quantity value";
          }
          else
          {
            $qty = mysqli_real_escape_string($dbc, $qty_cc);
          }

          if(empty($arr_err))
          {
            move_uploaded_file($_FILES["uplfimg"]["tmp_name"][0], $target_file);
            move_uploaded_file($_FILES["uplbimg"]["tmp_name"][0], $target_file1);




            $insert_qry= "INSERT INTO `tshirt` (`brand_id`, `category_id`, `color(front)`, `color(back)`, `design_title`, `features_id`, `fabric_id`, `type_id`, `img_front`, `img_back`, `pattern`, `price`, `size_id`, `quantity`) VALUES ('$brand', '$category', '$colorfront', '$colorback', '$design', '$features', '$fabric', '$type', '$target_file', '$target_file1', '$pattern', '$price', '$size', '$qty');";
            $insert_qry_exe = mysqli_query($dbc, $insert_qry);

            if($insert_qry_exe)
            {
              echo "<script>alert('New T-Shirt Added!');</script>";
            }
            else
            {
              echo "<script>alert('".mysqli_error($dbc)."')</script>;";
            }


          }

        }


      ?>

      <div class="tab-pane fade  show active " id="add_tshirt" role="tabpanel" aria-labelledby="add_tshirt-tab">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm">

                <!--Brands-->
                  <label for="Brands">Brands</label>
                  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="sltbrand" name="sltbrand">
                    <option value="0">Choose a brand..</option>
                    <?php
                    $sql ="Select * from brands";
                    $query = mysqli_query($dbc,$sql);
                    while ($row =mysqli_fetch_array($query)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      echo "<option value='$id'>$title</option>";
                    }
                    ?>
                  </select>
                  <span class="errfrm"><?php echo @$brand_err."<br>"; ?></span>

                <!--Category-->
                <label for="Category">Category</label>
                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="sltcat" name="sltcat" >
                  <option value="0">Choose a category..</option>
                  <?php
                  $sql ="Select * from category";
                  $query = mysqli_query($dbc,$sql);
                  while ($row =mysqli_fetch_array($query)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    echo "<option value='$id'>$title</option>";
                  }
                  ?>
                </select>
                <span class="errfrm"><?php echo @$cat_err."<br>"; ?></span>

              <!--Colour-->
                <label for="Color(Front)">Color(Front)</label>
                <input type="color"  placeholder="Pick a color" id="txtfcolor" name="txtfcolor">
                <label for="Color(Back)">Color(Back)</label>
                <input type="color"  placeholder="Pick a color" id="txtbcolor" name="txtbcolor">

                <div class="form-group has-error has-feedback">
                <label for="Design_Title">Design Title</label>
                <input type="text" class="form-control" name="txtdesign" id="txtdesign" placeholder="Design Title (e.g Animal logo)">
                <span class="errfrm"><?php echo @$design_err."<br>"; ?></span>
              </div>

                  <!--features-->
                  <label class="mr-sm-2" for="Features">Features</label>
                  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="sltfeature" name="sltfeature">
                    <option value="0">Choose a feature..</option>
                    <?php
                    $sql ="Select * from features";
                    $query = mysqli_query($dbc,$sql);
                    while ($row =mysqli_fetch_array($query)) {
                      $id = $row['id'];
                      $title = $row['title'];
                      echo "<option value='$id'>$title</option>";
                    }
                    ?>
                  </select>
                  <span class="errfrm"><?php echo @$features_err; ?> </span>
                </div>

            <!--Fabric-->
              <div class="col-sm">
              <label class="mr-sm-2" for="Fabrics">Fabrics</label>
              <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="sltfabric" name="sltfabric">
              <option value="0">Choose a fabric..</option>
              <?php

              $sql ="Select * from fabrics";
              $query = mysqli_query($dbc,$sql);
              while ($row =mysqli_fetch_array($query)) {
                $id = $row['id'];
                $title = $row['title'];
                echo "<option value='$id'>$title</option>";
              }
              ?>
              </select>
              <span class="errfrm"><?php echo @$fabric_err."<br>"; ?></span>

            <!--Type-->
            <!-- <div class="container"> -->
            <label for="Type">Type</label>
            <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="slttype" name="slttype">
              <option value="0">Choose a type..</option>
                <?php
                $sql ="Select * from type";
                $query = mysqli_query($dbc,$sql);
                while ($row =mysqli_fetch_array($query)) {
                $id = $row['id'];
                $title = $row['type'];
                echo "<option value='$id'>$title</option>";
                }
                ?>
            </select>
            <span class="errfrm"><?php echo @$type_err."<br>"; ?></span>
          <!-- </div> -->

              <!--Image Front-->
              <label for="Image_(front)">Image (front)</label>
              <input type="file" name="uplfimg[]" id="uplfimg" class="form-control" onchange="readURL(this);">
              <span class="errfrm"><?php echo @$img_f_err; ?></span>
               <img id="imgf_preview" src="#" alt="your image" width="160px" height="80px;"/><br>

              <script type="text/javascript">
              function readURL(input)
              {
                if (input.files && input.files[0])
                {
                  var reader = new FileReader();

                reader.onload = function (e)
                {
                    $('#imgf_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
                }
              }
              </script>


              <!--Image back-->
              <label for="Image_(back)">Image (back)</label>
              <input type="file" name="uplbimg[]" id="uplbimg" class="form-control" placeholder="Image back" onchange="document.getElementById('imgb_preview').src = window.URL.createObjectURL(this.files[0]);">
              <span class="errfrm"><?php echo @$img_b_err; ?></span>
              <img id="imgb_preview" src="#" alt=" image" width="160px" height="80px;" />
    </div>


      <div class="col-sm">
          <!--Pattern-->
          <label for="Pattern">Pattern</label>
          <input type="text" name="txtpat" id="txtpat" class="form-control" placeholder="Pattern">
          <span class="errfrm"><?php echo @$pattern_err."<br>"; ?> </span>

          <!--Price-->
          <label for="Price">Price</label>
          <input type="type" name="txtprice" id="txtprice" class="form-control" placeholder="Price">
          <span class="errfrm"><?php echo @$price_err."<br>"; ?> </span>

          <!--Size-->
          <label for="size">Size</label>
          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="sltsize" name="sltsize" >
            <option value="0">Choose a Size...</option>
            <?php
            $sql ="Select * from tbl_size";
            $query = mysqli_query($dbc,$sql);
            while ($row =mysqli_fetch_array($query)) {
              $id = $row['size_id'];
              $title = $row['size'];
              echo "<option value='$id'>$title</option>";
            }
            ?>
          </select>
          <span class="errfrm"><?php echo @$size_err."<br>"; ?></span>

          <!--Quantity-->
          <label for="">Quantity</label>
          <input type="text" name="txtqty" id="txtqty" class="form-control" placeholder="Quantity">
          <span class="errfrm"><?php echo @$qty_err."<br>"; ?> </span>

          <br><br>
          <script>
            function clrfrm()
            {
              location.reload();
            }
          </script>

          <!--Submit Button-->
          <button type="submit" class="btn btn-primary" name="btnsubas" id="btnsubas">Submit</button>
          <!--Reset Button-->
          <input class="btn btn-primary" name="btnreset" id="btnreset" type="button" onclick="clrfrm();" value="Reset">

      </div>
      </div>
    </div>
    </form>
    </div>

    <div class="tab-pane fade" id="modify_tshirt" role="tabpanel" aria-labelledby="modify_tshirt-tab">.2..</div>
    <div class="tab-pane fade" id="remove_tshirt" role="tabpanel" aria-labelledby="remove_tshirt-tab">..3.</div>
    <div class="tab-pane fade" id="view_tshirt" role="tabpanel" aria-labelledby="view_tshirt-tab">..4.</div>
    </div>

  </body>
</html>
