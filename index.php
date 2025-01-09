<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Dashboard</title>		
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
<link rel="shortcut icon" href="images/abnauk-logo.png" type="image/png">
</head>
<body>
<div class="wrapper">
	<?php include 'include/sidebar.php'; ?>
<!-- Page Content Holder -->
<div id="content">
	<?php include 'include/mainbar.php'; ?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
<?php
    require_once("include/connection.php");
    $sql= " SELECT count(uni_ID) AS total FROM tbl_universities";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalUniversities = $values['total'];
?>
<?php
    require_once("include/connection.php");
    $sql= " SELECT count(portal_ID) AS total FROM tbl_portals";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalPortals = $values['total'];
?>
<?php
    require_once("include/connection.php");
    $sql= " SELECT count(user_ID) AS total FROM tbl_users";
    $result = mysqli_query($conn, $sql);
    $values = mysqli_fetch_assoc($result);
    $totalUsers = $values['total'];
?>
<?php 
	if ($user_permissions == 4) {
		echo "Welcome!";
	}else{
?>		


	
        <div class="row">
	        	<div class="col-md-4 col-sm-6">
	        		<div class="widgets">
	               		<div class="row">
	               			<div class="col-md-3 col-xs-3">
	               				<center>
	               					<span style="padding-top: 20px;" class="widgets-span-danger fas fa-university fa-3x "></span>				
	               				</center>
	               			</div>
	               			<div class="col-md-9 col-xs-9">
	               				<h3 style="color: #73879c; padding-bottom: 8px;"> <span style="font-weight: 700; font-size: 32px;"><?php echo $totalUniversities; ?></span> Universities</h3>			
	               			</div>
	               		</div>
	               	</div><br>
				</div>
				<div class="col-md-4 col-sm-6">
	        		<div class="widgets">
	               		<div class="row">
	               			<div class="col-md-3 col-xs-3">
	               				<center>
	               					<span style="padding-top: 20px;" class="widgets-span-danger fas fa-window-restore fa-3x "></span>				
	               				</center>
	               			</div> 
	               			<div class="col-md-9 col-xs-9">
	               				<h3 style="color: #73879c; padding-bottom: 8px;"> <span style="font-weight: 700; font-size: 32px;"><?php echo $totalPortals; ?> </span>Portals</h3>			
	               			</div>
	               		</div>
	               	</div><br>
				</div>
				<div class="col-md-4 col-sm-12">
	        		<div class="widgets">
	               		<div class="row">
	               			<div class="col-md-3 col-xs-3">
	               				<center>
	               					<span style="padding-top: 20px;" class="widgets-span-danger fas fa-user-friends fa-3x "></span>				
	               				</center>
	               			</div>
	               			<div class="col-md-9 col-xs-9">
	               				<h3 style="color: #73879c; padding-bottom: 8px;"> <span style="font-weight: 700; font-size: 32px;"><?php echo $totalUsers; ?></span> Users</h3>			
	               			</div>
	               		</div>
	               	</div><br>
				</div>
			</div>
<?php
	}
 ?>
	
			<div class="row">
				<div class="col-md-6">
					<div class="form-wrapper">
						<h3 class="form-title">Portal finder</h3>
						<div class="row">
							<form action="find_best_portal.php" method="post">
								<div class="col-md-9 col-sm-12">
									<label class="pull-left">University *</label>	
									<input type="text" class="form-field" name="university" id="search" oninput="showDropdown()" placeholder="Search..." required>
									<?php  
											require_once('include/connection.php');
											$sql = "SELECT * FROM tbl_universities ORDER BY uni_name";
											$result = mysqli_query($conn, $sql);
											if (mysqli_num_rows($result)>0) {
												echo '<div id="dropdown">';
												while ($row = mysqli_fetch_assoc($result)) {
													$uniId = $row['uni_ID'];
													$uniName = $row['uni_name'];
	            									?>
	            									<div class="dropdown-item" 
	            									onclick="selectItem('<?php echo $uniName; ?>')"><?php echo $uniName; ?></div>
	            									<?php
												}
												echo '</div>';
											}
										?>
								</div>
								<div class="col-md-3 col-sm-12">
									<label style="display: block;">.</label>
									<input type="submit" name="findBestPortal" class="success-btn pull-right" value="Find Portal"><br><br>
								</div>
							</form>
						</div>
						<hr>
						<?php  
						if (isset($_GET['commissionList']) && isset($_GET['university'])) {
							$university = $_GET['university'];
							$commissionList = $_GET['commissionList'];
							echo '<div class="row">';
								echo '<div class="col-md-12">';
									echo '<p>Result for <strong>'.$university.'</strong></p>';
								echo '</div>';
							echo '</div>';
							echo '<div class="row portal-result-box">';
							foreach ($commissionList as $commission) {
								echo '<div class="col-md-2 col-sm-3 col-xs-4">';
									echo '<p class="'.$commission['flag'].'">'.$commission['portal_name'].'</p>';
									$commission['flag'] != 'red' 
									? $icon = '<i class="far fa-2x fa-check-circle '.$commission['flag'].'"></i>'
									: $icon = '<i class="far fa-2x fa-times-circle '.$commission['flag'].'"></i>';
									echo $icon;
								echo '</div>';
							}
							echo '</div>';
							echo '<br>';
						}elseif(isset($_GET['error']) && isset($_GET['university'])) {
							echo '<div class="row">';
								echo '<div class="col-md-12">';
									echo '<p>No record found for <strong>'.$_GET['university'].'</strong></p>';
								echo '</div>';
							echo '</div>';
						}
						?>
					</div>
				</div>
			</div>
		</div><!-- /Page Contents -->
	</div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>