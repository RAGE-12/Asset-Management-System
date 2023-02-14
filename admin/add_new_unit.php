<?php
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Add Product Type</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Product Type</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" form action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Item Name:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Item name" name="itemname" />
              </div>
            </div>
            <div class="alert alert-danger" id="error" style="display:none">
            This Item already exist!
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
                  <th>Item name</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $res=mysqli_query($link, "SELECT * FROM units");
              while($row=mysqli_fetch_array($res))
              {
                ?>
                <tr>
                  <td><?php echo $row["id"]; ?></td>
                  <td><?php echo $row["unit"]; ?></td>
                  <td><a href="edit_item.php?id=<?php echo $row["id"]; ?>" style="color:Blue">Edit</a></td>
                  <td><a href="delete_item.php?id=<?php echo $row["id"]; ?>" style="color:Red">Delete</a></td>

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
    $res=mysqli_query($link, "SELECT * FROM `units` where unit='$_POST[itemname]'");
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
        mysqli_query($link,"insert into units values(NULL,'$_POST[itemname]')") or die(mysqli_error($link));
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
