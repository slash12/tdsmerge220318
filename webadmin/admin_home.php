<?php require("no_redirect.php");
error_reporting(E_ALL & ~E_WARNING);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ShirtPrints - Add T-Shirt Form</title>
    <link rel="stylesheet" href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/file-upload-with-preview.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.form.js"></script>
    <script src="../js/popper-select.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-select.min.js"></script>

    <script>
    $(document).ready(function()
    {
     $('.selectpicker').selectpicker();
    });
    </script>

  </head>
  <body>
    <?php require('../includes/admin_navbar.php'); ?>
      

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

          // Design Validation
          $design_cc = $_POST['sltdesign'];
          if($design_cc == "0")
          {
            $arr_err[] = "Please choose a design";
            $design_err = "Please choose a design";
          }
          else
          {
            $design = mysqli_real_escape_string($dbc, $design_cc);
          }

          // Type Validation
          $type_cc = $_POST['slttype'];
          if($type_cc == "0")
          {
            $arr_err[] = "Please choose a type";
            $type_err = "<br>Please choose a type";
          }
          else
          {
            $type = mysqli_real_escape_string($dbc, $type_cc);
          }

          if ($_FILES['uplfimg']['error'] == 0)
          {
            //Image Front Validation
            $uploadfile_imgf=$_FILES["uplfimg"]["tmp_name"];
            $folder_imgf="../images/tshirt/";
            @$target_file_imgf = $folder_imgf.basename($_FILES["uplfimg"]["name"]);
            $imageFileType_imgf = pathinfo($target_file_imgf, PATHINFO_EXTENSION);

            //Size Validation(>500 kb denied)
           if ($_FILES["uplfimg"]["size"] > 500000)
            {
              $img_f_err = "Sorry, Image Front is too large.";
              $arr_err[] = "Sorry, Image Front is too large.";
              echo "<script> $(document).ready(function(){
                $('#imgfval').modal({show: true});
                  }); </script>";
            }

            //Image front format check
            if($imageFileType_imgf != "jpg" && $imageFileType_imgf != "png" && $imageFileType_imgf != "jpeg")
            {
              $img_f_err = "Sorry, only JPG, JPEG and PNG front image are allowed.";
              $arr_err[] = "Sorry, only JPG, JPEG and PNG front image are allowed.";
              echo "<script> $(document).ready(function(){
                $('#imgfval').modal({show: true});
                  }); </script>";
            }

          }
          else
          {
            $img_f_err = "Image Front Upload Error";
            $arr_err[] = "Image Front Upload Error";
            echo "<script> $(document).ready(function(){
              $('#imgfval').modal({show: true});
                }); </script>";
            //echo "<script>alert('Error Uploading Image Front: ".$_FILES['uplbimg']['error']."');</script>";
          }
          
          if ($_FILES['uplbimg']['error']== 0)
          {
            //Image Back Validation
            $uploadfile_imgb=$_FILES["uplbimg"]["tmp_name"];
            $folder_imgb="../images/tshirt/";
            @$target_file_imgb = $folder_imgb.basename($_FILES["uplbimg"]["name"]);
            $imageFileType_imgb = pathinfo($target_file_imgb, PATHINFO_EXTENSION);

            
              //Size Validation(>500 kb denied)
              if ($_FILES["uplbimg"]["size"] > 500000)
              {
                $img_b_err = "Sorry, your image back is too large.";
                $arr_err[] = "Sorry, your image back is too large.";
                echo "<script> $(document).ready(function(){
                  $('#imgbval').modal({show: true});
                    }); </script>";
              }

              //image back format check
              if($imageFileType_imgb != "jpg" && $imageFileType_imgb != "png" && $imageFileType_imgb != "jpeg")
              {
                $img_b_err = "Sorry, only JPG, JPEG and PNG back image are allowed.";
                $arr_err[] = "Sorry, only JPG, JPEG and PNG back image are allowed.";
                echo "<script> $(document).ready(function(){
                  $('#imgbval').modal({show: true});
                    }); </script>";
              } 
             
          }
          else
          {
            $img_b_err = "Image Back Upload Error";
            $arr_err[] = "Image Back Upload Error";
            echo "<script> $(document).ready(function(){
              $('#imgbval').modal({show: true});
                }); </script>";
            //echo "<script>alert('Error Uploading Image Back: ".$_FILES['uplbimg']['error']."');</script>";
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
            $size_err = "<br>Please choose a size";
          }
          else
          {
            $size = mysqli_real_escape_string($dbc, $size_cc);
          }

          // Quantity Validation
          $qty_cc = trim($_POST['txtqty']);
          if(empty($qty_cc))
          {
            $arr_err[] = "Please enter a quantity value (> 0)";
            $qty_err = "Please enter a quantity value (> 0)";
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

          @$color_cc = $_POST["ddcolor"];
            if(empty($color_cc))
              {
                $color_err = "<br>Please select a color";
              }

            @$features_cc = $_POST['sltfeature'];
            if(empty($features_cc))
              {
                $features_err = "<br>Please select a feature";
              }

            $fabric_cc = @$_POST['sltfabric'];
            if(empty($fabric_cc))
              {
                $fabric_err = "<br>Please select a fabric";
              }

            $pattern_cc = @$_POST['sltpat'];
            if(empty($pattern_cc))
            {
              $pattern_err = "Please enter a pattern";
            }

          if(empty($arr_err))
          {
          
            mysqli_autocommit($dbc,FALSE);



            $insert_qry= "INSERT INTO `tbl_tshirt` (`brand_id`, `category_id`, `design_id`, `type_id`, `img_front`, `img_back`, `price`, `size_id`, `quantity`) VALUES ('$brand', '$category', '$design', '$type', '$target_file_imgf', '$target_file_imgb', '$price', '$size', '$qty');";
            $insert_qry_exe = mysqli_query($dbc, $insert_qry);

            

            if($insert_qry_exe)
            {
              //take the last t-shirt generated id
              $shirt_id = mysqli_insert_id($dbc);
              //echo $shirt_id."<br>";

              //Color dropdown validation + insert to color associative
             
              if(isset($color_cc))
              {
                foreach ($color_cc as $color)
                {
                  $res_color = mysqli_query($dbc, "INSERT INTO tbl_tshirt_color(tshirt_id, color_id) VALUES('$shirt_id', '$color');");
                }
              }
              else
              {
                //$color_err = "<br>Please select a color";
                mysqli_rollback($dbc);
              }

              //Color associative insert check
              // if($res_color)
              // {
              //   mysqli_commit($dbc);
              // }

              //Features Validation + insert to features associative
              if(isset($features_cc))
              {
                foreach ($features_cc as $feature)
                {
                  $res_feature = mysqli_query($dbc, "INSERT INTO tbl_tshirt_features(tshirt_id, feature_id) VALUES('$shirt_id', '$feature');");
                }
              }
              else
              {
                //$features_err = "<br>Please select a feature";
                mysqli_rollback($dbc);
              }

              //features associative insert check
              // if($res_feature)
              // {
              //   mysqli_commit($dbc);
              // }

              // Fabric Validation + insert to fabric associative
              if(isset($fabric_cc))
              {
                foreach ($fabric_cc as $fabric)
                {
                  $res_fabric = mysqli_query($dbc, "INSERT INTO tbl_tshirt_fabric(tshirt_id, fabric_id) VALUES('$shirt_id', '$fabric');");
                }
              }
              else
              {
                //$fabric_err = "<br>Please select a fabric";
                mysqli_rollback($dbc);
              }

              //fabric associative insert check
              // if($res_fabric)
              // {
              //   mysqli_commit($dbc);
              // }

            // Pattern Validation + insert to features associative
             if(isset($pattern_cc))
             {
               foreach ($pattern_cc as $pattern)
               {
                 $res_pattern = mysqli_query($dbc, "INSERT INTO tbl_tshirt_pattern(tshirt_id, pattern_id) VALUES('$shirt_id', '$pattern');");
               }

             }
             else
             {
               //$pattern_err = "Please enter a pattern";
               mysqli_rollback($dbc);
             }           

             //pattern associative insert check
              // if($res_pattern)
              // {
              //   mysqli_commit($dbc);
              // }

              if($res_color && $res_feature && $res_fabric && $res_pattern)
              {
                move_uploaded_file($_FILES["uplfimg"]["tmp_name"], $target_file_imgf);
                move_uploaded_file($_FILES["uplbimg"]["tmp_name"], $target_file_imgb);
                echo "<script> $(document).ready(function(){
                  $('#addshirtsuc').modal({show: true});
                    }); </script>";
                mysqli_commit($dbc);
              }

            }
          }
        }
      ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm">

                <!--Brands-->
                  <label for="Brands">Brands</label>
                  <select class="selectpicker" id="sltbrand" name="sltbrand">
                    <option value="0">Choose a brand..</option>
                    <?php
                    $sql ="Select * from tbl_brand";
                    $query = mysqli_query($dbc,$sql);
                    while ($row =mysqli_fetch_array($query)) {
                      $brand_id = $row['brand_id'];
                      $brand = $row['brand'];
                      ?>
                      <option value='<?php echo $brand_id;?>' <?php if(@$_POST['sltbrand']==$brand_id){echo 'selected';} ?>><?php echo $brand;?></option>";
                      <?php
                    }
                    ?>
                  </select>
                  <!-- Brand modal Trigger Button -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#brandmodal">Add Brand</button>

                  <span class="errfrm"><?php echo @$brand_err."<br>"; ?></span>

                <!--Category-->
                <label for="Category">Category</label>
                <select class="selectpicker" id="sltcat" name="sltcat" data-width="201px">
                  <option value="0">Choose a category..</option>
                  <?php
                  $sql ="Select * from tbl_category";
                  $query = mysqli_query($dbc,$sql);
                  while ($row =mysqli_fetch_array($query)) {
                    $cat_id = $row['cat_id'];
                    $category = $row['cat_name'];
                    ?>
                    <option value='<?php echo $cat_id; ?>' <?php if(@$_POST['sltcat']==$cat_id){echo 'selected';} ?>><?php echo $category; ?></option>";
                    <?php
                  }
                  ?>
                </select>

                <!-- Category modal Trigger Button -->
                  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#catmodal">Add Category</button>


                <span class="errfrm"><?php echo @$cat_err."<br>"; ?></span>

              <!--Colour-->
                <label class="mr-sm-2" for="Color">Color</label>
                <select id="ddcolor" name="ddcolor[]" class="selectpicker" data-live-search="true" data-size="5" title="Choose a Color/s"  multiple>
                  <?php
                    $sql_color = "SELECT * FROM tbl_color;";
                    $sql_color_exe = mysqli_query($dbc, $sql_color);

                    while($colrow = mysqli_fetch_array($sql_color_exe, MYSQLI_ASSOC))
                    {?>
                        <option value="<?php echo $colrow['color_id']?>" data-tokens="<?php echo $colrow['color'];?>" data-subtext="<?php echo $colrow['color_code'];?>" style='background:<?php echo $colrow['color_code'];?>; color: black;' <?php foreach(@$_POST['ddcolor'] as $col){if($col==$colrow['color_id']){echo "selected";}} ?>><?php echo $colrow['color'];?></option>;
                      <?php
                    }
                  ?>
                </select>

                <!-- Color modal Trigger Button -->
                  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#colormodal">Add Color</button>

                <span class="errfrm"><?php echo @$color_err."<br>"; ?></span>

                <!--Design-->
                <label for="Design">Design</label>
                <select class="selectpicker" id="sltdesign" name="sltdesign" data-live-search="true" data-size="5" >
                  <option value="0" selected>Choose Design..</option>
                  <?php
                  $sql_design ="Select * from tbl_design;";
                  $sql_design_exe = mysqli_query($dbc,$sql_design);
                  while ($designrow =mysqli_fetch_array($sql_design_exe, MYSQLI_ASSOC))
                  {
                    ?>
                    <option value='<?php echo $designrow['design_id'];?>' data-tokens='<?php echo $designrow['design'];?>' <?php if(@$_POST['sltdesign'] == $designrow['design_id']){echo "selected";}?>><?php echo $designrow['design'];?></option>;
                    <?php
                  }
                  ?>
                </select>
                <!-- Design modal Trigger Button -->
                  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#designmodal">Add Design</button>
                <span class="errfrm"><?php echo "<br>".@$design_err."<br>"; ?></span>


                  <!--features-->
                  <label class="mr-sm-2" for="Features">Features</label>
                  <select class="selectpicker" id="sltfeature" data-width="201px" name="sltfeature[]" data-live-search="true" data-size="5" title="Choose feature/s"  multiple>
                    <?php
                    $sql_feature ="Select * from tbl_feature;";
                    $sql_feature_exe = mysqli_query($dbc,$sql_feature);
                    while ($featurerow =mysqli_fetch_array($sql_feature_exe))
                    {
                      ?>
                      <option value="<?php echo $featurerow['feature_id'];?>" data-tokens="<?php echo $featurerow['feature'];?>" <?php foreach(@$_POST['sltfeature'] as $col){if($col==$featurerow['feature_id']){echo "selected";}} ?>><?php echo $featurerow['feature'];?></option>;
                      <?php
                    }
                    ?>
                  </select>
                  <!-- Features modal Trigger Button -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#featuresmodal">Add Feature</button>
                  <span class="errfrm"><?php echo @$features_err; ?> </span>
                </div>

            <!--Fabric-->
              <div class="col-sm">
              <label class="mr-sm-2" for="Fabrics">Fabrics</label>
              <select class="selectpicker" id="sltfabric" name="sltfabric[]" data-live-search="true" data-size="5" title="Choose fabric/s"  multiple>
              <?php
              $sql_fabric ="Select * from tbl_fabric";
              $sql_fabric_exe = mysqli_query($dbc,$sql_fabric);
              while ($fabricrow =mysqli_fetch_array($sql_fabric_exe, MYSQLI_ASSOC))
              {
                ?>
                <option value="<?php echo $fabricrow['fabric_id'];?>" data-tokens="<?php echo $fabricrow['fabric'];?>" <?php foreach(@$_POST['sltfabric'] as $col){if($col==$fabricrow['fabric_id']){echo "selected";}} ?>><?php echo $fabricrow['fabric'];?></option>
                <?php
              }
              ?>
              </select>
              <!-- Fabric modal Trigger Button -->
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#fabricmodal">Add Fabric</button>
              <span class="errfrm"><?php echo @$fabric_err."<br>"; ?></span>

            <!--Type-->
            <label for="Type">Type</label>
            <select class="selectpicker" id="slttype" name="slttype">
              <option value="0">Choose a type..</option>
                <?php
                $sql ="Select * from tbl_type";
                $query = mysqli_query($dbc,$sql);
                while ($row =mysqli_fetch_array($query)) {
                $id = $row['type_id'];
                $title = $row['type'];
                ?>
                <option value='<?php echo $id;?>' <?php if(@$_POST['slttype']==$id){echo "selected";} ?>><?php echo $title;?></option>";
                <?php
                }
                ?>
            </select>
            <span class="errfrm"><?php echo @$type_err."<br>"; ?></span>
            <div id="fade" class="black_overlay"></div>
               <div class="custom-file-container" data-upload-id="imgf">
               <label>T-Shirt Front <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
               <label class="custom-file-container__custom-file" >
                  <input type="file" id="uplfimg[]" name="uplfimg" class="custom-file-container__custom-file__custom-file-input">
                  <span class="custom-file-container__custom-file__custom-file-control"></span>
               </label>
               
               <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Image Front Preview</a>
                <div id="light" class="custom-file-container__image-preview"><a class="closebtn" href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
                </div>
               
               
              <div class="custom-file-container" data-upload-id="imgb">
              <label>T-Shirt Back <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
              <label class="custom-file-container__custom-file" >
                  <input type="file" id="uplbimg[]" name="uplbimg" class="custom-file-container__custom-file__custom-file-input">
                  <span class="custom-file-container__custom-file__custom-file-control"></span>
              </label>
             
                <a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='block';document.getElementById('fade').style.display='block'">Image Back Preview</a>
                <div id="light2" class="custom-file-container__image-preview"><a class="closebtn" href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
                
              </div>
              

    </div>


      <div class="col-sm">
          <!--Pattern-->
          <label for="Pattern">Pattern</label>
          <select class="selectpicker icon-menus" title="Select a pattern" id="sltpat" name="sltpat[]" data-live-search="true" data-size="5" multiple>
          <?php
          $sql_pattern ="Select * from tbl_pattern;";
          $sql_pattern_exe = mysqli_query($dbc,$sql_pattern);
          while ($patternrow =mysqli_fetch_array($sql_pattern_exe, MYSQLI_ASSOC))
          {
            ?>
            <option data-content="<img src='<?php echo $patternrow['p_img_path']; ?>' width='15px' height='15px'> <?php echo $patternrow['pattern']; ?>" value="<?php echo $patternrow['pattern_id']; ?>" data-tokens="<?php echo $patternrow['pattern'] ?>" <?php foreach(@$_POST['sltpat'] as $col){if($col==$patternrow['pattern_id']){echo "selected";}} ?>></option>;
            <?php
          }
          ?>
          </select>
          <!-- Fabric modal Trigger Button -->
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#patternmodal">Add Pattern</button>
          <span class="errfrm"><?php echo @$pattern_err."<br>"; ?> </span>

          <!--Price-->
          <label for="Price">Price</label>
          <input type="type" name="txtprice" id="txtprice" class="form-control" placeholder="Price" value="<?php if(!empty(@$_POST['txtprice'])){echo @$_POST['txtprice'];} ?>">
          <span class="errfrm"><?php echo @$price_err."<br>"; ?> </span>

          <!--Size-->
          <label for="size">Size</label>
          <select class="selectpicker" id="sltsize" name="sltsize" >
            <option value="0">Choose a Size...</option>
            <?php
            $sql ="Select * from tbl_size";
            $query = mysqli_query($dbc,$sql);
            while ($row =mysqli_fetch_array($query)) {
              $id = $row['size_id'];
              $title = $row['size'];
              ?>
              <option value='<?php echo $id; ?>' <?php if(@$_POST['sltsize'] == $id){echo 'selected';} ?>><?php echo $title; ?></option>";
              <?php
            }
            ?>
          </select>
          <span class="errfrm"><?php echo @$size_err."<br>"; ?></span>

          <!--Quantity-->
          <label for="">Quantity</label>
          <input type="text" name="txtqty" id="txtqty" class="form-control" placeholder="Quantity" value="<?php if(!empty(@$_POST['txtqty'])){echo @$_POST['txtqty'];} ?>">
          <span class="errfrm"><?php echo @$qty_err."<br>"; ?> </span>

          <br><br>
          <script>
            function clrfrm()
            {
              location.reload();
            }
          </script>

          <!--Submit Button-->
          <input type="submit" class="btn btn-primary" name="btnsubas" id="btnsubas">
          <!--Reset Button-->
          <input class="btn btn-primary" name="btnreset" id="btnreset" type="button" onclick="clrfrm();" value="Reset">

      </div>
      </div>
    </div>
    </form>

    <!--Brand Modal Body -->
    <div class="modal fade" id="brandmodal" tabindex="-1" role="dialog" aria-labelledby="mybrandmodal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Brand</span>
                </div>
                <input type="text" class="form-control" placeholder="Brand.." aria-label="brand" name="txtabrand" id="txtabrand">
                <input type="submit" class="btn btn-primary" id="btnabrand" name="btnabrand" Value="Add Brand">
              </div>
              <span id="brand_availability"></span>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!--Brand AJAX Validation (Uniqueness)-->
    <script>
      $(document).ready(function(){
        document.getElementById("btnabrand").disabled = true;
        $('#txtabrand').blur(function(){
          var abrand = $(this).val();
          $.ajax({
            url: "plugins/chkbrand.php",
            method: "POST",
            data: {add_brand:abrand},
            success:function(html)
            {
              if(html == "true")
              {
                $('#brand_availability').html('<span class="text-danger">Brand already existed!</span>');
                document.getElementById("btnabrand").disabled = true;
              }

              if(html == "false")
              {
                if(abrand == "")
                {
                  $('#brand_availability').html('<span class="text-danger">Enter a Brand!</span>');
                  document.getElementById("btnabrand").disabled = true;
                }
                else
                {
                  $('#brand_availability').html('<span></span>');
                  document.getElementById("btnabrand").disabled = false;
                }

              }
            }
          })
        })
      });
    </script>

    <!--Insert Brand into DB-->
    <?php
    if(isset($_POST['btnabrand']))
    {
      $addbrand_cc = trim($_POST['txtabrand']);
      $addbrand = mysqli_real_escape_string($dbc, $addbrand_cc);
      $addbrand_qry = mysqli_query($dbc, "INSERT INTO tbl_brand(brand) VALUES('$addbrand');");
      if($addbrand_qry)
      {
        echo "<meta http-equiv='refresh' content='0'>";
      }
    }
    ?>

<!--================================================================================================================================================= -->
<!--Category Modal Body -->
<div class="modal fade" id="catmodal" tabindex="-1" role="dialog" aria-labelledby="mycatmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Category</span>
            </div>
            <input type="text" class="form-control" name="txtacat" id="txtacat" placeholder="Category..">
            <input type="submit" class="btn btn-primary" name="btnacat" id="btnacat" value="Add Category">
          </div>
          <span id="cat_availability"></span>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Category AJAX Validation (Uniqueness)-->
<script>
  $(document).ready(function(){
    document.getElementById("btnacat").disabled = true;
    $('#txtacat').blur(function(){
      var acat = $(this).val();
      $.ajax({
        url: "plugins/chkcat.php",
        method: "POST",
        data: {add_cat:acat},
        success:function(html)
        {
          if(html == "true")
          {
            if(acat == "")
            {
              $('#cat_availability').html('<span class="text-danger">Enter a Category!</span>');
              document.getElementById("btnacat").disabled = true;
            }
            else
            {
              $('#cat_availability').html('<span class="text-danger">Category already existed!</span>');
              document.getElementById("btnacat").disabled = true;
            }
          }

          if(html == "false")
          {
            if(acat == "")
            {
              $('#cat_availability').html('<span class="text-danger">Enter a Category!</span>');
              document.getElementById("btnacat").disabled = true;
            }
            else
            {
              $('#cat_availability').html('<span></span>');
              document.getElementById("btnacat").disabled = false;
            }
          }
        }
      })
    })
  });
</script>

<!--Insert Category into DB-->
<?php
if(isset($_POST['btnacat']))
{
  $addcat_cc = $_POST['txtacat'];
  $addcat = mysqli_real_escape_string($dbc, $addcat_cc);
  $addcat_qry = mysqli_query($dbc, "INSERT INTO tbl_category(cat_name) VALUES('$addcat');");
  if($addcat_qry)
  {
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
?>

<!--================================================================================================================================================= -->
<!--Color Modal Body -->
<div class="modal fade" id="colormodal" tabindex="-1" role="dialog" aria-labelledby="mycolormodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Color</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Color</span>
            </div>
            <input type="text" class="form-control" name="txtacolor" id="txtacolor" placeholder="Color..">
            <input type="text" class="form-control" name="txtaccolor" id="txtaccolor" placeholder="Color Code..">
          </div>
          <input type="submit" class="btn btn-primary" name="btnacolor" id="btnacolor" value="Add Color">
          <span id="color_availability"></span>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Color AJAX Validation (Uniqueness)-->
<script>
  $(document).ready(function(){
    document.getElementById("btnacolor").disabled = true;
    $('#txtacolor').blur(function(){
      var acolor = $(this).val();
      $.ajax({
        url: "plugins/chkcolor.php",
        method: "POST",
        data: {add_color:acolor},
        success:function(html)
        {
          if(html == "true")
          {
            if(acolor == "")
            {
              $('#color_availability').html('<span class="text-danger">Enter a Color!</span>');
              document.getElementById("btnacolor").disabled = true;
            }
            else
            {
              $('#color_availability').html('<span class="text-danger">Color already existed!</span>');
              document.getElementById("btnacolor").disabled = true;
            }
          }

          if(html == "false")
          {
            if(acolor == "")
            {
              $('#color_availability').html('<span class="text-danger">Enter a Color!</span>');
              document.getElementById("btnacolor").disabled = true;
            }
            else
            {
              $('#color_availability').html('<span></span>');
              document.getElementById("btnacolor").disabled = false;
            }
          }
        }
      })
    })
  });
</script>

<!--Insert Color into DB-->
<?php
if(isset($_POST['btnacolor']))
{
  $addcolor_cc = trim($_POST['txtacolor']);
  $addccolor_cc = trim($_POST['txtaccolor']);
  $addcolor = mysqli_real_escape_string($dbc, $addcolor_cc);
  $addccolor = mysqli_real_escape_string($dbc, $addccolor_cc);
  $addcolor_qry = mysqli_query($dbc, "INSERT INTO tbl_color(color, color_code) VALUES('$addcolor', '$addccolor');");
  if($addcolor_qry)
  {
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
?>
<!--================================================================================================================================================= -->
<!--Design Modal Body -->
<div class="modal fade" id="designmodal" tabindex="-1" role="dialog" aria-labelledby="mydesignmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Design</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Design</span>
            </div>
            <input type="text" class="form-control" name="txtadesign" id="txtadesign" placeholder="Design..">
            <input type="submit" class="btn btn-primary" name="btnadesign" id="btnadesign" value="Add Design">
          </div>
          <span id="design_availability"></span>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Design AJAX Validation (Uniqueness)-->
<script>
  $(document).ready(function(){
    document.getElementById("btnadesign").disabled = true;
    $('#txtadesign').blur(function(){
      var adesign = $(this).val();
      $.ajax({
        url: "plugins/chkdesign.php",
        method: "POST",
        data: {add_design:adesign},
        success:function(html)
        {
          if(html == "true")
          {
            if(adesign == "")
            {
              $('#design_availability').html('<span class="text-danger">Enter a Design!</span>');
              document.getElementById("btnadesign").disabled = true;
            }
            else
            {
              $('#design_availability').html('<span class="text-danger">Design already existed!</span>');
              document.getElementById("btnadesign").disabled = true;
            }
          }

          if(html == "false")
          {
            if(adesign == "")
            {
              $('#design_availability').html('<span class="text-danger">Enter a Design!</span>');
              document.getElementById("btnadesign").disabled = true;
            }
            else
            {
              $('#design_availability').html('<span></span>');
              document.getElementById("btnadesign").disabled = false;
            }
          }
        }
      })
    })
  });
</script>

<!--Insert Design into DB-->
<?php
if(isset($_POST['btnadesign']))
{
  $adddesign_cc = $_POST['txtadesign'];
  $adddesign = mysqli_real_escape_string($dbc, $adddesign_cc);
  $adddesign_qry = mysqli_query($dbc, "INSERT INTO tbl_design(design) VALUES('$adddesign');");
  if($adddesign_qry)
  {
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
?>
<!--================================================================================================================================================= -->
<!--Features Modal Body -->
<div class="modal fade" id="featuresmodal" tabindex="-1" role="dialog" aria-labelledby="myfeaturesmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Feature</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Feature</span>
            </div>
            <input type="text" class="form-control" name="txtafeature" id="txtafeature" placeholder="Feature..">
            <input type="submit" class="btn btn-primary" name="btnafeature" id="btnafeature" value="Add Feature">
          </div>
          <span id="feature_availability"></span>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Feature AJAX Validation (Uniqueness)-->
<script>
  $(document).ready(function(){
    document.getElementById("btnafeature").disabled = true;
    $('#txtafeature').blur(function(){
      var afeature = $(this).val();
      $.ajax({
        url: "plugins/chkfeature.php",
        method: "POST",
        data: {add_feature:afeature},
        success:function(html)
        {
          if(html == "true")
          {
            if(afeature == "")
            {
              $('#feature_availability').html('<span class="text-danger">Enter a Feature!</span>');
              document.getElementById("btnafeature").disabled = true;
            }
            else
            {
              $('#feature_availability').html('<span class="text-danger">Feature already existed!</span>');
              document.getElementById("btnafeature").disabled = true;
            }
          }

          if(html == "false")
          {
            if(afeature == "")
            {
              $('#feature_availability').html('<span class="text-danger">Enter a Feature!</span>');
              document.getElementById("btnafeature").disabled = true;
            }
            else
            {
              $('#feature_availability').html('<span></span>');
              document.getElementById("btnafeature").disabled = false;
            }
          }
        }
      })
    })
  });
</script>

<!--Insert Feature into DB-->
<?php
if(isset($_POST['btnafeature']))
{
  $addfeature_cc = $_POST['txtafeature'];
  $addfeature = mysqli_real_escape_string($dbc, $addfeature_cc);
  $addfeature_qry = mysqli_query($dbc, "INSERT INTO tbl_feature(feature) VALUES('$addfeature');");
  if($addfeature_qry)
  {
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
?>
<!--================================================================================================================================================= -->
<!--fabric Modal Body -->
<div class="modal fade" id="fabricmodal" tabindex="-1" role="dialog" aria-labelledby="myfabricmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Fabric</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Fabric</span>
            </div>
            <input type="text" class="form-control" name="txtafabric" id="txtafabric" placeholder="Fabric..">
            <input type="submit" class="btn btn-primary" name="btnafabric" id="btnafabric" value="Add Fabric">
          </div>
          <span id="fabric_availability"></span>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Fabric AJAX Validation (Uniqueness)-->
<script>
  $(document).ready(function(){
    document.getElementById("btnafabric").disabled = true;
    $('#txtafabric').blur(function(){
      var afabric = $(this).val();
      $.ajax({
        url: "plugins/chkfabric.php",
        method: "POST",
        data: {add_fabric:afabric},
        success:function(html)
        {
          if(html == "true")
          {
            if(afabric == "")
            {
              $('#fabric_availability').html('<span class="text-danger">Enter a Fabric!</span>');
              document.getElementById("btnafabric").disabled = true;
            }
            else
            {
              $('#fabric_availability').html('<span class="text-danger">Fabric already existed!</span>');
              document.getElementById("btnafabric").disabled = true;
            }
          }

          if(html == "false")
          {
            if(afabric == "")
            {
              $('#fabric_availability').html('<span class="text-danger">Enter a Fabric!</span>');
              document.getElementById("btnafabric").disabled = true;
            }
            else
            {
              $('#fabric_availability').html('<span></span>');
              document.getElementById("btnafabric").disabled = false;
            }
          }
        }
      })
    })
  });
</script>

<!--Insert Fabric into DB-->
<?php
if(isset($_POST['btnafabric']))
{
  $addfabric_cc = $_POST['txtafabric'];
  $addfabric = mysqli_real_escape_string($dbc, $addfabric_cc);
  $addfabric_qry = mysqli_query($dbc, "INSERT INTO tbl_fabric(fabric) VALUES('$addfabric');");
  if($addfabric_qry)
  {
    echo "<meta http-equiv='refresh' content='0'>";
  }
}
?>
<!--================================================================================================================================================= -->
<!--Pattern Modal Body -->
<div class="modal fade" id="patternmodal" tabindex="-1" role="dialog" aria-labelledby="mypatternmodal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Pattern</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">Pattern</span>
            </div>
            <input type="text" class="form-control" name="txtapattern" id="txtapattern" placeholder="Pattern..">
            <input type="file" id="uplpatimg" name="uplpatimg">
          </div>
          <span id="pattern_availability"></span>
          <input type="submit" class="btn btn-primary" name="btnapattern" id="btnapattern" value="Add Pattern">
        </form>
      </div>
    </div>
  </div>
</div>

<!--Pattern AJAX Validation (Uniqueness)-->
<script>
  $(document).ready(function(){
    document.getElementById("btnapattern").disabled = true;
    $('#txtapattern').blur(function(){
      var apattern = $(this).val();
      $.ajax({
        url: "plugins/chkpattern.php",
        method: "POST",
        data: {add_pattern:apattern},
        success:function(html)
        {
          if(html == "true")
          {
            if(apattern == "")
            {
              $('#pattern_availability').html('<span class="text-danger">Enter a Pattern!</span>');
              document.getElementById("btnapattern").disabled = true;
            }
            else
            {
              $('#pattern_availability').html('<span class="text-danger">Pattern already existed!</span>');
              document.getElementById("btnapattern").disabled = true;
            }
          }

          if(html == "false")
          {
            if(apattern == "")
            {
              $('#pattern_availability').html('<span class="text-danger">Enter a Pattern!</span>');
              document.getElementById("btnapattern").disabled = true;
            }
            else
            {
              $('#pattern_availability').html('<span></span>');
              document.getElementById("btnapattern").disabled = false;
            }
          }
        }
      })
    })
  });
</script>

<!--Insert Pattern into DB-->
<?php
if(isset($_POST['btnapattern']))
{
  //Pattern Add image Validation
$check_num = 0;
$target_dir_pat = "../images/tshirt_pattern/";
$target_file_pat = $target_dir_pat . basename($_FILES["uplpatimg"]["name"]);
$imageFileType_pat = strtolower(pathinfo($target_file_pat,PATHINFO_EXTENSION));

//Size Validation(>500 kb denied)
if ($_FILES["uplpatimg"]["size"] > 500000 || $_FILES["uplpatimg"]["error"] == 1)
{
  $txt_err = "Sorry, your image is too large.";
  echo "<script> $(document).ready(function(){
    $('#adpatvalsize').modal({show: true});
      }); </script>";
 $check_num = 1;
}

elseif($imageFileType_pat != "jpg" && $imageFileType_pat != "png" && $imageFileType_pat != "jpeg")
{
  $txt_err = "Sorry, only JPG, JPEG and PNG files are allowed.";
  echo "<script> $(document).ready(function(){
    $('#adpatvalsize').modal({show: true});
      }); </script>";

  $check_num = 1;
}

if($check_num == 0)
{
  move_uploaded_file($_FILES["uplpatimg"]["tmp_name"], $target_file_pat);
  $addpattern_cc = $_POST['txtapattern'];
  $addpattern = mysqli_real_escape_string($dbc, $addpattern_cc);
  require('plugins/image/SimpleImage.php');
  
  $img = new claviska\SimpleImage($target_file_pat);
  
  try {
  $img->fromFile($target_file_pat);
  $pat_path = "../images/tshirt_pattern/".$addpattern.".".$imageFileType_pat;
  unlink($target_file_pat);
  $img->resize(100, 100)->toFile($pat_path);
  
  } catch(Exception $err) {
  echo "<script>alert('Error: '" .$e->getMessage()."');</script>";
  }

  }

  $addpattern_qry = mysqli_query($dbc, "INSERT INTO tbl_pattern(pattern, p_img_path) VALUES('$addpattern', '$pat_path');");
  if($addpattern_qry)
  {
    echo "<meta http-equiv='refresh' content='0'>";
  }

}

?>

<!-- Add pattern size validation Modal -->
<div class="modal fade" id="adpatvalsize" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="text-warning">Error</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p><?php echo $txt_err ?></p>
        </div>
      </div>
    </div>
</div>

<!-- image back validation Modal -->
<div class="modal fade" id="imgbval" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="text-warning">Image Back Error</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p><?php echo $img_b_err ?></p>
        </div>
      </div>
    </div>
</div>

<!-- image front validation Modal -->
<div class="modal fade" id="imgfval" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="text-warning">Image Front Error</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p><?php echo $img_f_err ?></p>
        </div>
      </div>
    </div>
</div>

<!-- New T-Shirt added Modal -->
<div class="modal fade" id="addshirtsuc" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="text-success">Success!</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>New T-Shirt Added!</p>
        </div>
      </div>
    </div>
</div>

    
    <script src="../js/file-upload-with-preview.js"></script>
    <script>
      var upload1 = new FileUploadWithPreview('imgf');
      var upload2 = new FileUploadWithPreview('imgb');
    </script>
    <?php require('../includes/admin_footer.php'); ?>
  </body>
</html>
