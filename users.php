<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Users</title>		
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
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-4">
								<h3 class="box-title">Users</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-8">
								<div class="main-action-box">
									<a href="createUser.php" class="primary-btn">Create New</a>
								</div>
							</div>
						</div>						
					</div><br>
				</div>
			</div>

			<?php  
			require_once("include/connection.php");
			$sql = "SELECT * FROM tbl_profile 
			INNER JOIN tbl_users ON tbl_users.user_ID = tbl_profile.user_FK";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0) {
				echo '<div class="row">';
				while($row = mysqli_fetch_assoc($result)){
					$profile_ID = $row['profile_ID'];
					$first_name = $row['profile_first_name'];
					$last_name = $row['profile_last_name'];
					$phone = $row['profile_phone'];
					$picture = $row['profile_picture'];
					$user_ID = $row['user_ID'];
					$user_designation = $row['user_designation'];
					$user_permission = $row['user_permissions'];
					$username = $row['user_username'];
					$email = $row['user_email'];

					if ($user_permission == 1) {
						$userPermission = "Administrator";
					}elseif ($user_permission == 2) {
						$userPermission = "Moderator";
					}elseif ($user_permission == 3) {
						$userPermission = "Viewer";
					}
					$picture == null ?
			        $profilePic = '<img class="img-circle profile-pic" width="100" height="100" src="images/user.jpg">':
			        $profilePic = '<img class="img-circle profile-pic" width="100" height="100" src="'.$picture.'">';
			        ?>
			        <div class="col-md-6 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<div class="row"><br>
							<div class="col-md-3 col-sm-3 col-xs-3">
								<center>
									<br><?php echo $profilePic; ?>
								</center>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<h4 class="profile-name"><?php echo $first_name." ".$last_name; ?></h4>
								<span><?php echo $user_designation; ?></span>
								<br><br>
								<span class="profile-data">
									<i class="fas fa-user-cog"></i><?php echo $userPermission; ?>
								</span><br>
									<span class="profile-data">
										<i class="fas fa-at"></i> <?php echo $username; ?>
									</span><br>
									<span class="profile-data">
										<i class="far fa-envelope-open"></i> <?php echo $email; ?>
									</span>
									<span class="profile-data">
										<i class="fas fa-phone"></i> <?php echo $phone; ?>
									</span>
									<br><br><br>
								</div>
							</div>
						</div><br>
					</div>

			        <?php

		        }
		        echo '</div>';
			}
			?>



		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>