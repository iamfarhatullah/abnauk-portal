<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Commissions</title>		
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
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		require_once("include/connection.php");
		$sql = "SELECT * FROM tbl_commissions WHERE commission_ID='$id'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)>0) {
			$row = mysqli_fetch_assoc($result);
			$commissionPercent = $row['commission_percent'];
			$portalFK = $row['portal_FK'];
			$universityFK = $row['university_FK'];
			$actionBtn = 'updateCommission';
		}else{
			header("Location: commissions.php");
		}

	}else{
		$id=null;
		$commissionPercent = '';
		// $image = '';
		$actionBtn = 'submitCommission';
	}
	?>
    <div class="container-fluid">				
        <div class="content-box"> <!-- Page Contents -->
			<div class="row" style="display: none;">
				<div class="col-md-12">
					
					<div class="form-wrapper">
						<h3 class="form-title">Add New Commission</h3>
						<form action="submitCommission.php" method="post" enctype="multipart/form-data"><br>
							<div class="row">
								<div class="col-md-3 col-sm-12">
									<label class="">Portal *</label>
									<select class="form-field" name="portalID" required>
										<option value="">Select Portal</option>
										<?php  
											require_once('include/connection.php');
											$sql = "SELECT * FROM tbl_portals";
											$result = mysqli_query($conn, $sql);
											if (mysqli_num_rows($result)>0) {
												while ($row = mysqli_fetch_assoc($result)) {
													$portalID = $row['portal_ID'];
													$portalName = $row['portal_name'];
													// if ($countryId == $country) { 
													// 	$select_attribute = 'selected'; 
													// } else{
													// 	$select_attribute = '';
													// }
													echo "<option value='".$portalID."'>".$portalName."</option>";
												}
											}
										?>
									</select>		
								</div>
								<div class="col-md-5 col-sm-12">
									<label class="pull-left">University *</label>	
									<select class="form-field" name="uniID" required>
										<option value="">Select University</option>
										<?php  
											require_once('include/connection.php');
											$sql = "SELECT * FROM tbl_universities";
											$result = mysqli_query($conn, $sql);
											if (mysqli_num_rows($result)>0) {
												while ($row = mysqli_fetch_assoc($result)) {
													$uniID = $row['uni_ID'];
													$uniName = $row['uni_name'];
													
													echo "<option value='".$uniID."'>".$uniName."</option>";
												}
											}
										?>
									</select>		
								</div>
								<div class="col-md-4 col-sm-12">
									<label>Percentage *</label>	
									<input type="number" name="percentage" value="<?php echo $commissionPercent; ?>" class="form-field" placeholder="Enter Percentage (%)">		
								</div>
							</div>
							<br>							
							<input type="hidden" name="commissionID" value="<?php echo $id; ?>">
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
			<!-- <br>
			<br> -->
			<div class="row"> 
				<div class="col-md-12 col-sm-12 col-xs-12">
					<?php 
					if (isset($_GET['success'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>Edited successfully</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					}
					?>
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<h3 class="box-title">Commissions List</h3>	
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="main-action-box">
									<a href="editCommissions.php" class="primary-btn">Edit</a>
								</div>
							</div>
						</div>
						
			            <div class="row">
			                <div class="col-md-12">
			                    <input type="text" id="searchInput" onkeyup="searchTable()" class="form-field" placeholder="Search for universities or countries...">
			                </div>
			            </div>
						<?php 
						require_once("include/connection.php");
						$sqlUni = "SELECT * FROM tbl_universities 
								INNER JOIN tbl_countries ON tbl_countries.id = tbl_universities.country_FK
								ORDER BY uni_name, tbl_countries.name";
						$resultUni = mysqli_query($conn, $sqlUni);
						if (mysqli_num_rows($resultUni)>0) {
							$serialNo = 0;
							echo '<table id="commissionTable" class="table table-striped table-hover">';
								echo '<thead>';
									echo '<tr>';
										echo '<th scope="col" style="width:4%">#</th>';
										echo '<th scope="col" style="width:12%">Country</th>';
										echo '<th scope="col" style="width:40%">University</th>';
										$sqlPortal = "SELECT * FROM tbl_portals ORDER BY portal_ID";
											$resultPortal = mysqli_query($conn, $sqlPortal);
											if (mysqli_num_rows($resultPortal) > 0) {
												while($rowPortal = mysqli_fetch_assoc($resultPortal)){
													$portalID = $rowPortal['portal_ID'];
													$portalName = $rowPortal['portal_name'];
													echo '<th scope="col" style="width:8%">'.$portalName.'</th>';
												}
											}
									echo '</tr>';
								echo '</thead>';
							while($rowUni = mysqli_fetch_assoc($resultUni)){
								$serialNo++;
								$uniID = $rowUni['uni_ID'];
								$uniName = $rowUni['uni_name'];
								$countryName = $rowUni['name'];
								echo '<tr>';
									echo '<td>'.$serialNo.'</td>';
									echo '<td>'.$countryName.'</td>';
									echo '<td>'.$uniName.'</td>';
									$sqlPortal = "SELECT * FROM tbl_portals ORDER BY portal_ID";
										$resultPortal = mysqli_query($conn, $sqlPortal);
										if (mysqli_num_rows($resultPortal) > 0) {
											while($rowPortal = mysqli_fetch_assoc($resultPortal)){
												$portalID = $rowPortal['portal_ID'];
												$portalName = $rowPortal['portal_name'];

												$sqlCommission = "SELECT * FROM tbl_commissions WHERE portal_FK=".$portalID." AND university_FK=".$uniID;
												$commissionResult = mysqli_query($conn, $sqlCommission);
												if (mysqli_num_rows($commissionResult)>0) {
													$row = mysqli_fetch_assoc($commissionResult);
													$commissionPercent = $row['commission_percent'];
													echo '<td>';
														echo $commissionPercent.' %';
													echo '</td>';
												}else{
													echo '<td>';
														echo '0 %';
													echo '</td>';
												}
											
											}
										}
								echo '</tr>';			
							}
							echo '</table>';
							
							echo '<hr>';
							
						}else{
							echo "Please add universities first";
						}

						?>
					</div><br>
				</div>
			</div><br>	
		</div><!-- /Page Contents -->
	</div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>


