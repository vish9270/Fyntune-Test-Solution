<?php include 'common.php';?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include 'head.php';?>


<body>
    <div id="wrapper">
        <?php include 'nav.php';?>
      
		<div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Welcome <small>Admin</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Dashboard</a></li>
					  <li class="active">Applicants Data</li>
					</ol> 
									
		</div>
            <div id="page-inner">

                <!-- /. ROW  -->
	
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <!-- Delete Guest Code Written Here in PHP -->
                            <?php if(isset($_GET['delete_id'])){
                                
                                $row_id=$_GET['delete_id'];

                                $sql = "UPDATE guest  SET `g_deleted`=1 WHERE gid='$row_id'";
                                if(mysqli_query($tcon, $sql))
                                {
                                    echo '<div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Applicant Deleted Successfully
                                            </div>';
                                } 
                                else{
                                
                                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($tcon);
                                    echo '<div class="alert alert-danger alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Could Not Able to Delete the Applicant Please Try Again
                                            </div>';
                            }

                                
                            }?>

                        <div class="panel-heading">
                             Applicant's Score Card
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Email Id</th>
                                            <th>Score (Out of 100)</th>
                                            <th>Attempted On</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        $sql="select *  from `guest` WHERE `g_deleted`=0";
                                        if($res = mysqli_query($tcon, $sql)){
                                        
                                            if($count=mysqli_num_rows($res)>0)
                                            {
                                                while($row=mysqli_fetch_assoc($res)){?>
                                                    <tr>
                                                    <td><?php echo $row['g_name'];?></td>
                                                    <td><?php echo $row['g_email'];?></td>
                                                    <td><?php echo $row['g_score'];?></td>
                                                    <td class="center"><?php echo date(date_format(date_create($row['date_created']),"d/m/Y"));?></td>
                                                    <td class="center"><a class="btn btn-danger" name="delete_btn" href="home.php?delete_id=<?php echo $row['gid'];?>" onclick="return confirm('Are you sure you want to delete the applicant?')"><span><i class="fa fa-trash"></i></span> Delete</a>
                                    </td>
                                                </tr>
                                                <?php }
                                                }
                                            }?>
                                        
                                      
                                              
                                        
                                       
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    
                    </div>
                    <!--End Advanced Tables -->
               
                </div>
			
		
				<footer><p>All right reserved. Crafted by: Wishvesh Ujawane</p>
				
        
				</footer>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
<?php include 'footerjs.php';?>

</body>

</html>