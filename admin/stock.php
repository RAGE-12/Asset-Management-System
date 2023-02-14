<?php
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            STOCK</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>STOCK</h5>
        </div>
        

         <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Product Company</th>
                  <th>Product Code</th>
                  <th>Item type</th>
                  <th>quantity</th>

                </tr>
              </thead>
              <tbody>

              <?php
              $count = 0;
              $res=mysqli_query($link, "SELECT * FROM stock");
              while($row=mysqli_fetch_array($res))
              {
                  $count = $count + 1;
                ?>
                <tr>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $row["product_company"]; ?></td>
                  <td><?php echo $row["product_name"]; ?></td>
                  <td><?php echo $row["product_unit"]; ?></td>
                  <td><?php echo $row["product_qty"]; ?></td>

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
include "footer.php";
?>