<?php
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Distribution</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Distribution</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" form action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Select Company:</label>
              <div class="controls">
                <select class="span11" name="company_name" id="company_name">
                    <option>select</option>
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
              <label class="control-label">Select Product Code:</label>
              <div class="controls" id="product_name">
                <select class="span11" name="product_name" id="product_name">
                    <option>select</option>
                    <?php
                    $res=mysqli_query($link,"select *from products");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option>";
                        echo $row["product_name"];
                        echo "</option>";
                    }

                    ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Item Type :</label>
              <div class="controls" id="unit">
                <select class="span11" name="unit" id="unit">
                    <option>select</option>
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
              <label class="control-label">Required quantity:</label>
              <div class="controls" name="required" id="required">
                <input type="text" name="required" class="span11" id="required">
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Department Name:</label>
              <div class="controls">
              <select class="span11" name="department" id="department">
                    <option>select</option>
                    <?php
                    $res=mysqli_query($link,"select *from dept_info");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option>";
                        echo $row["department"];
                        echo "</option>";
                    }

                    ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Select Employee Name:</label>
              <div class="controls" name="Issued_to" id="Issued_to">
              <select class="span11" name="Issued_to" id="Issued_to">
                    <option>select</option>
                    <?php
                    $res=mysqli_query($link,"select *from dept_info");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<option>";
                        echo $row["Issued_to"];
                        echo "</option>";
                    }

                    ?>
                </select>
              </div>
            </div>

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Distribute</button>
            </div>

            <div class="alert alert-success" id="success" style="display:none">
            Distribution Inserted Successfully!
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
                  <th>Required quantity</th>
                  <th>Department Name</th>
                  <th>Employee Name</th>

                </tr>
              </thead>
              <tbody>

              <?php
              $res=mysqli_query($link, "SELECT * FROM distribution");
              while($row=mysqli_fetch_array($res))
              {
                ?>
                <tr>
                  <td><?php echo $row["id"]; ?></td>
                  <td><?php echo $row["company_name"]; ?></td>
                  <td><?php echo $row["product_name"]; ?></td>
                  <td><?php echo $row["unit"]; ?></td>
                  <td><?php echo $row["required"]; ?></td>
                  <td><?php echo $row["department"]; ?></td>
                  <td><?php echo $row["Issued_to"]; ?></td>

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
  mysqli_query($link, "insert into distribution values(NULL,'$_POST[company_name]','$_POST[product_name]','$_POST[unit]','$_POST[required]','$_POST[department]','$_POST[Issued_to]')") or die(mysqli_error($link));
  $count = 0;
  $res = mysqli_query($link, "select *from stock where product_company='$_POST[company_name]' && product_name='$_POST[product_name]' && product_unit='$_POST[unit]'");
  $count = mysqli_num_rows($res);

  if($count>0)
  {
    mysqli_query($link, "update stock set product_qty=product_qty-$_POST[required] where product_company='$_POST[company_name]' && product_name='$_POST[product_name]' && product_unit='$_POST[unit]'") or die(mysqli_error($link));
    mysqli_query($link, "update products set quantity=quantity-$_POST[required] where company_name='$_POST[company_name]' && product_name='$_POST[product_name]' && unit='$_POST[unit]'") or die(mysqli_error($link));

  }
  ?>
  <script type="text/javascript">
    document.getElementById("success").style.display="block";
    setTimeout(function(){
            window.location.href=window.location.href;
        },3000);
  </script>
  <?php
}
?>

<?php
include "footer.php";
?>