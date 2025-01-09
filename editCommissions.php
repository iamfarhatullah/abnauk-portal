<?php include 'include/session.php'; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width" />
<meta name="author" content="">
<title>Edit Commissions</title>		
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
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-6">
								<h3 class="box-title">Edit Commissions</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-6">
								<div class="main-action-box">
									<!-- <a href="" class="success-btn">Submit</a> -->
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
							echo '<form method="post" action="submitAllCommissions.php">';
							echo '<table id="commissionTable" class="table table-striped table-hover">';
								echo '<thead>';
									echo '<tr>';
										echo '<th scope="col" style="width:3%">#</th>';
										echo '<th scope="col" style="width:10%">Country</th>';
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
														echo '<input type="text" class="percentage-field" name="'.$portalName.''.$serialNo.'" value="'.$commissionPercent.'" placeholder="0.0">';
													echo '</td>';
												}else{
													echo '<td>';
														echo '<input type="text" class="percentage-field" name="'.$portalName.''.$serialNo.'" value="" placeholder="0">';
													echo '</td>';
												}
											}
										}
								echo '</tr>';		
								echo '<input type="hidden" name="uniID'.$serialNo.'" value="'.$uniID.'">';				
							}
							echo '</table>';
							
							echo '<hr>';
							
							echo '<div class="row">';
								echo '<div class="col-md-12">';
									echo '<div class="pull-right">';
										echo '<input type="hidden" name="serialNo" value="'.$serialNo.'">';
										echo '<input type="submit" class="success-btn" name="submitAllCommissions" value="Submit">';		
									echo '</div>';
								echo '</div>';
							echo '</div>';
							echo '</form>';
							echo '<br>';
						}else{
							echo "Please add universities first";
						}

						?>
					</div><br>
				</div>
			</div>
			<br>
			

		</div><!-- /Page Contents -->
	</div>
</div>

<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>


