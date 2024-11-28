<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>User</title>		
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
	require_once("include/connection.php");
	$id = $_GET['id'];
	$sql = "SELECT * FROM tbl_profile 
	INNER JOIN tbl_users ON tbl_users.user_ID = tbl_profile.user_FK
	WHERE profile_ID='$id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) {
		$row = mysqli_fetch_assoc($result);
		$profile_ID = $row['profile_ID'];
		$first_name = $row['profile_first_name'];
		$last_name = $row['profile_last_name'];
		$bio = $row['profile_bio'];
		$phone = $row['profile_phone'];
		$picture = $row['profile_picture'];
		$user_ID = $row['user_ID'];
		$user_permission = $row['user_permissions'];
		$username = $row['user_username'];
		$email = $row['user_email'];
		$user_designation = $row['user_designation'];

		if ($user_permission == 1) {
			$userPermission = "Admin";
		}elseif ($user_permission == 2) {
			$userPermission = "Moderator";
		}elseif ($user_permission == 3) {
			$userPermission = "Viewer";
		}
		$picture == null ?
        $profilePic = '<img class="img-circle profile-pic" width="150" height="150" src="images/user.jpg">':
        $profilePic = '<img class="img-circle profile-pic" width="150" height="150" src="'.$picture.'">';
	}

	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<div class="row"><br>
							<div class="col-md-3 col-sm-3">
								<center>
									<br>
									<?php echo $profilePic; ?>
								</center>
							</div>
							<div class="col-md-9 col-sm-9">
								<h3 class="profile-name"><?php echo $first_name." ".$last_name; ?></h3>
								<span class="profile-data">Role: <?php echo $userPermission; ?></span><br><br>
								<span class="profile-data"><i class="fas fa-at"></i> <?php echo $username; ?></span>
								<span class="profile-data"><i class="far fa-envelope-open"></i> <?php echo $email; ?></span>
								<span class="profile-data"><i class="fas fa-phone"></i> <?php echo $phone; ?></span>
							</div>
						</div><br><br>
					</div>
				</div>
			</div>

		</div><!-- /Page Contents -->
	</div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>