<?php
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Add New Products</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add New Products</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" form action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Select Company:</label>
              <div class="controls">
                <select class="span11" name="company_name">
                    <?php
                    $res=mysqli_query($link,"select *from company_name");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option>";
                        echo $row["company_name"];
                        echo "</option>";
                    }

                    ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter Product Code:</label>
              <div class="controls">
                <input type="text" name="product_name" class="span11" placeholder="Product code">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Item Type :</label>
              <div class="controls">
                <select class="span11" name="unit">
                    <?php
                    $res=mysqli_query($link,"select *from units");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option>";
                        echo $row["unit"];
                        echo "</option>";
                    }

                    ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Enter quantity:</label>
              <div class="controls">
                <input type="text" name="quantity" class="span11" placeholder="Specify Quantity">
              </div>
            </div>

            <div class="alert alert-danger" id="error" style="display:none">
            This Product already exist!
</div>

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Save</button>
            </div>

            <div class="alert alert-success" id="success" style="display:none">
            Record Inserted Successfully!
</div>

            
            </form>
         </div>

         <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Company Name</th>
                  <th>Product Code</th>
                  <th>Item type</th>
                  <th>quantity</th>

                </tr>
              </thead>
              <tbody>

              <?php
              $res=mysqli_query($link, "SELECT * FROM products");
              while ($row = mysqli_fetch_array($res)) {
              ?>
                <tr>
                  <td><?php echo $row["id"]; ?></td>
                  <td><?php echo $row["company_name"]; ?></td>
                  <td><?php echo $row["product_name"]; ?></td>
                  <td><?php echo $row["unit"]; ?></td>
                  <td><?php echo $row["quantity"]; ?></td>

                  <td><a href="edit_products.php?id=<?php echo $row["id"]; ?>" style="color:Blue">Edit</a></td>
                  <td><a href="delete_products.php?id=<?php echo $row["id"]; ?>" style="color:Red">Delete</a></td>

                </tr>
                <?php
              }

              ?>
                
                
              </tbody>
            </table>
          </div>
        </div>

    </div>
</div>
</div>
</div>

<?php
 if (isset($_POST["submit1"]))
 {
    $count=0;
    $res=mysqli_query($link, "SELECT * FROM products where company_name='$_POST[company_name]' && product_name='$_POST[product_name]' && unit='$_POST[unit]' && quantity='$_POST[quantity]'") or die(mysqli_error($link));
    $count=mysqli_num_rows($res);

    if($count>0)
    {
       ?>
       <script type="text/javascript">
        document.getElementById("success").style.display="none";
        document.getElementById("error").style.display="block";
       </script>
       <?php 
    }
    else{
        mysqli_query($link,"insert into products values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[quantity]')") or die(mysqli_error($link));
        mysqli_query($link, "insert into stock values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[quantity]')") or die(mysqli_error($link));

        ?>
        <script type="text/javascript">
        document.getElementById("error").style.display="none";
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location.href=window.location.href;
        },3000);
       </script>
       <?php 
    }
 }
?>

<?php
include "footer.php";
?>