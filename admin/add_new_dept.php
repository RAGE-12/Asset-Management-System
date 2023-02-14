<?php
include "header.php";
include "../user/connection.php";
?>
<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Add Department</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Department</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" form action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Department:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Department" name="department" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Employee Name:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Employee Name" name="employee" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Employee Id:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Employee Id" name="empid" />
              </div>
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
                  <th>Department</th>
                  <th>Employee Name</th>
                  <th>Employee Id</th>
                </tr>
              </thead>
              <tbody>

              <?php
              $res=mysqli_query($link, "SELECT * FROM dept_info");
              while($row=mysqli_fetch_array($res))
              {
                ?>
                <tr>
                  <td><?php echo $row["id"]; ?></td>
                  <td><?php echo $row["department"]; ?></td>
                  <td><?php echo $row["Issued_to"]; ?></td>
                  <td><?php echo $row["empid"]; ?></td>
                  <td><a href="edit_dept.php?id=<?php echo $row["id"]; ?>" style="color:Blue">Edit</a></td>
                  <td><a href="delete_dept.php?id=<?php echo $row["id"]; ?>" style="color:Red">Delete</a></td>

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
   
        mysqli_query($link,"insert into dept_info values(NULL,'$_POST[department]','$_POST[employee]','$_POST[empid]')") or die(mysqli_error($link));
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
