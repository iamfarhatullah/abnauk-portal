<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Universities</title>		
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
	<?php  
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		require_once("include/connection.php");
		$sql = "SELECT * FROM tbl_universities WHERE uni_ID='$id'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_assoc($result);
			$name = $row['uni_name'];
			$image = $row['uni_picture'];
			$country = $row['country_FK'];
			$actionBtn = 'updateUni';
			$formTitle = 'Update University';
		}else{
			header("Location: universities.php");
		}

	}else{
		$id=null;
		$name = '';
		$image = '';
		$actionBtn = 'submitUni';
		$country = '';
		$formTitle = 'Add University';
	}
	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row">
				<div class="col-md-12">
					<?php if (isset($_GET['error'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Error</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['notUpdated'])) {
						echo "<div class='callout callout-danger'>";
						echo "<p>Error</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['created'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>University added successfully!</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}elseif (isset($_GET['updated'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>University updated successfully!</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					} ?>
					<div class="form-wrapper">
						<h3 class="form-title"><?php echo $formTitle; ?></h3>
						<form action="submitUniversity.php" method="post" enctype="multipart/form-data"><br>
							<div class="row">
								<div class="col-md-7 col-sm-7">
									<label>Name *</label>	
									<input type="text" name="name" value="<?php echo $name; ?>" class="form-field" placeholder="Enter University Name">		
								</div>
								<div class="col-md-5 col-sm-5">
									<label>Country *</label>	
									<select class="form-field" name="country" required>
										<option value="">Select Country</option>
										<?php  
											require_once('include/connection.php');
											$sql = "SELECT * FROM tbl_countries WHERE id IN (230, 231, 75, 223)";
											$result = mysqli_query($conn, $sql);
											if (mysqli_num_rows($result)>0) {
												while ($row = mysqli_fetch_assoc($result)) {
													$countryId = $row['id'];
													$countryName = $row['name'];
													if ($countryId == $country) { 
														$select_attribute = 'selected'; 
													} else{
														$select_attribute = '';
													}
													echo "<option value='".$countryId."' ".$select_attribute.">".$countryName."</option>";
												}
											}
										?>
									</select>		
								</div>
							</div>
							<br>						
							<input type="hidden" name="uniID" value="<?php echo $id; ?>">
							<hr>
							<div class="row">
								<div class="col-md-12">
									<div class="pull-right">
										<input type="reset" class="primary-btn" value="Reset">
										<input type="submit" name="<?php echo $actionBtn; ?>" class="success-btn" value="Submit">	
									</div>
									<br><br>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>

			

		</div><!-- /Page Contents -->
	</div>
</div>
<script type="text/javascript">
	function confirmDelete(uni_id, uni_name) {
            let confirmation = confirm("Are you sure you want to delete "+ uni_name +"?");
            if (confirmation) {
                // Redirect to the PHP script that handles the deletion
                window.location.href = "delete_university.php?id=" + uni_id;
            }
        }
</script>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>


