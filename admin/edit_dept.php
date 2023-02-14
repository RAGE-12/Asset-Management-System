<?php
include "header.php";
include "../user/connection.php";
$id = $_GET["id"];
$department = "";
$Issued_to = "";
$empid = "";

$res = mysqli_query($link, "select *from dept_info where id= $id");
while($row=mysqli_fetch_array($res))
{
    $department =$row["department"];
    $Issued_to = $row["Issued_to"];
    $empid = $row["empid"];

}
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
          <h5>Edit Department Info</h5>
        </div>
        <div class="widget-content nopadding">
          <form name="form1" form action="" method="post" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Department:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Department" name="department" value="<?php echo $department; ?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Issue to:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Issued to" name="issuedto" value="<?php echo $Issued_to; ?>"  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Employee Id:</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Employee Id" name="empid" value="<?php echo $empid; ?>"  />
              </div>
            </div>
            

            <div class="form-actions">
              <button type="submit" name="submit1" class="btn btn-success">Update</button>
            </div>

            <div class="alert alert-success" id="success" style="display:none">
            Record updated Successfully!
</div>

            
            </form>
         </div>

         
        </div>

    </div>
</div>
</div>
</div>

<?php
 if (isset($_POST["submit1"]))
 {
   
        mysqli_query($link,"update dept_info set department='$_POST[department]',Issued_to='$_POST[issuedto]',empid='$_POST[empid]' where id=$id") or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
        document.getElementById("success").style.display="block";
        setTimeout(function(){
            window.location="add_new_dept.php";
        },3000);
       </script>
       <?php 
    }
?>

<?php
include "footer.php";
?>
