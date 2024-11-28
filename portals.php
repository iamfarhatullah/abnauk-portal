<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Portals</title>		
<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>﻿
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="font-awesome-5.3.1/css/all.css">
<link rel="icon" href="../img/logo/logo.png" type="image/png">
</head>
<body>
<div class="wrapper">
	<?php include 'include/sidebar.php'; ?>
<!-- Page Content Holder -->
<div id="content">
	<?php include 'include/mainbar.php'; ?>
	<?php  
	// if (isset($_GET['id'])) {
	// 	$id = $_GET['id'];
	// 	require_once("include/connection.php");
	// 	$sql = "SELECT * FROM tbl_portals WHERE portal_ID='$id'";
	// 	$result = mysqli_query($conn, $sql);
	// 	if (mysqli_num_rows($result)>0) {
	// 		$row = mysqli_fetch_assoc($result);
	// 		$name = $row['portal_name'];
	// 		$image = $row['portal_picture'];
	// 		$actionBtn = 'updatePortal';
	// 	}else{
	// 		header("Location: portals.php");
	// 	}

	// }else{
	// 	$id=null;
	// 	$name = '';
	// 	$image = '';
	// 	$actionBtn = 'submitPortal';
	// }
	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<!-- <div class="row">
				<div class="col-md-12">
					<div class="form-wrapper">
						<h3 class="form-title">Add Portal</h3>
						<form action="submitBlog.php" method="post" enctype="multipart/form-data"><br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Name *</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="text" name="name" value="<?php echo $name; ?>" class="form-field" placeholder="Enter portal name">		
								</div>
							</div>
							<br>
							<br>
							<div class="row">
								<div class="col-md-2 col-sm-3">
									<label class="pull-right">Image</label>		
								</div>
								<div class="col-md-6 col-sm-9">
									<input type="hidden" name="storedImage" value="<?php echo $image; ?>">
									<input type="file" name="image" class="form-field" accept="image/*">		
								</div>
							</div>
							
							
							<input type="hidden" name="portalID" value="<?php echo $id; ?>">
							<hr>
							<div class="row">
								<div class="col-md-offset-2 col-md-6 col-sm-offset-3">
									<input type="reset" class="primary-btn" value="Reset">
									<input type="submit" name="<?php echo $actionBtn; ?>" class="success-btn" value="Submit"><br><br>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
			<br> -->
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-6">
								<h3 class="box-title">Portals</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-6">
								<div class="main-action-box">
									<!-- <a href="createPortal.php" class="sm-primary-btn">Add New</a> -->
								</div>
							</div>
						</div>
						<table class="table table-striped table-hover">
						<?php  
						require_once("include/connection.php");
						$sql = "SELECT * FROM tbl_portals";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result)>0) {
							$serialNo = 1;
							echo "<thead>";
							echo "<tr>";
							echo '<th scope="col" style="width:6%">#</th>
									<th scope="col" style="width:12%">Logo</th>
									<th scope="col" style="width:85%">Name</th>';
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>".$serialNo."</td>";
								$row['portal_picture'] == null ?
						        $profilePic = '<td><img class="img-circle" width="40" height="40" src="images/user.jpg"></td>':
						        $profilePic = '<td><img class="img-circle" width="40" height="40" src="'.$row['portal_picture'].'"></td>';
        						echo $profilePic;
								echo '<td>'.$row['portal_name'].'</td>';
								// echo "<td><a href='viewPortal.php?id=".$row['portal_ID']."' class='sm-primary-btn'>Viewww</a></td>";
								echo "</tr>";
								$serialNo++;
							}
							echo "</tbody>";
							echo "</table>";
						}
						?>
						
					</div><br>
				</div>
			</div>

		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>


