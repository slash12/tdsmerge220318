<?php require('../includes/dbconnect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShirtPrints | Manage T-Shirt</title>
    <title>ShirtPrints - Add T-Shirt Form</title>
    <link rel="stylesheet" href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/responsive.dataTables.min.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.dataTables.min.js"></script>
    <script src="../js/dataTables.bootstrap4.min.js"></script>
    <script src="../js/main_admin.js"></script>
    <script src="../js/dataTables.responsive.min.js"></script>
</head>
<body>
    <?php require('../includes/admin_navbar.php'); ?>
        <div class="row">
            <div class="col-lg-12">
                <h2>T-Shirt Stock</h2>
            </div>
        </div>
        <table id="mtstbl" class="display responsive nowrap">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Category</th>
                <th>Design</th>
                <th>Pattern</th>
                <th>Type</th>
                <th>Colors</th>
                <th>Fabrics</th>
                <th>Features</th>
                <th>Size</th>
                <th>Price(MUR)</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $tshirt_select = "SELECT 
            ts.tshirt_id AS tshirt_id,
            ts.price AS Price,
            ts.quantity AS Quantity,
            GROUP_CONCAT(DISTINCT tp.pattern) AS Pattern, 
            GROUP_CONCAT(DISTINCT tc.color) As Color,
            GROUP_CONCAT(DISTINCT tf.fabric) As Fabric,
            GROUP_CONCAT(DISTINCT te.feature) As Feature,
            (SELECT brand FROM tbl_brand tb WHERE tb.brand_id = ts.brand_id) As Brand,
            (SELECT cat_name FROM tbl_category tcat WHERE tcat.cat_id = ts.category_id) As Category,
            (SELECT design FROM tbl_design tde WHERE tde.design_id = ts.design_id) As Design,
            (SELECT type FROM tbl_type ty WHERE ty.type_id = ts.type_id) As Type,
            (SELECT size FROM tbl_size tsi WHERE tsi.size_id = ts.size_id) As Size
            FROM tbl_tshirt_pattern tsp, tbl_pattern tp, tbl_tshirt ts, tbl_tshirt_color tsc, tbl_color tc, tbl_fabric tf, tbl_tshirt_fabric tsf, tbl_feature te, tbl_tshirt_features tfe
            WHERE ts.tshirt_id = tsp.tshirt_id 
            AND tsp.pattern_id = tp.pattern_id
            AND ts.tshirt_id = tsc.tshirt_id
            AND tsc.color_id = tc.color_id
            AND tsf.tshirt_id = ts.tshirt_id
            AND tsf.fabric_id = tf.fabric_id
            AND tfe.tshirt_id = ts.tshirt_id
            AND tfe.feature_id = te.feature_id
            GROUP BY ts.tshirt_id";
            $tshirt_select_qry = mysqli_query($dbc, $tshirt_select);
            
            while($row_msa = mysqli_fetch_array($tshirt_select_qry))
            {
                ?>
                <tr>
                <td><?php echo $row_msa['Brand'];?> </td>
                <td><?php echo $row_msa['Category'];?> </td>
                <td><?php echo $row_msa['Design'];?> </td>
                <td><?php echo $row_msa['Pattern'];?> </td>
                <td><?php echo $row_msa['Type'];?> </td>
                <td><?php echo $row_msa['Color'];?> </td>
                <td><?php echo $row_msa['Fabric'];?> </td>
                <td><?php echo $row_msa['Feature'];?> </td>
                <td><?php echo $row_msa['Size'];?> </td>
                <td><?php echo $row_msa['Price'];?> </td>
                <td><?php echo $row_msa['Quantity'];?> </td>
                <td><a href="admin_home.php?uptshirt='<?php echo $row_msa['tshirt_id'] ?>'" class="btn btn-info">Modify</a> | <a href="#" class="btn btn-warning">Delete</a></td>
                </tr>
                <?php
            }
        ?>
        </tbody>
        </table>
    <?php require('../includes/admin_footer.php');?>
    
</body>
</html>