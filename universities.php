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
					}elseif (isset($_GET['deleted'])) {
						echo "<div class='callout callout-success'>";
						echo "<p>University deleted successfully!</p>";
						echo "<button class='close-callout' onclick='removeCallout(window.location.href);'><i class='fas fa-times'></i></button>";
						echo "</div>";
					} ?>
					

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="form-wrapper">
						<div class="row">
							<div class="col-md-6 col-sm-8 col-xs-6">
								<h3 class="box-title">Universities List</h3>	
							</div>
							<div class="col-md-6 col-sm-4 col-xs-6">
								<div class="main-action-box">
									<a href="createUniversity.php" class="primary-btn">Add New</a>
								</div>
							</div>
						</div>
			            <div class="row">
			                <div class="col-md-12">
			                    <input type="text" id="searchInput" onkeyup="searchTable()" class="form-field" placeholder="Search for universities or countries...">
			                </div>
			            </div>
						<table id="commissionTable" class="table table-striped table-hover">
						<?php  
						require_once("include/connection.php");
						$sql = "SELECT * FROM tbl_universities 
						INNER JOIN tbl_countries ON tbl_countries.id = tbl_universities.country_FK";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result)>0) {
							$serialNo = 1;
							echo "<thead>";
							echo "<tr>";
							echo '<th scope="col" style="width:5%">#</th>
									<th scope="col" style="width:10%">Logo</th>
									<th scope="col" style="width:55%">Name</th>
									<th scope="col" style="width:20%">Country</th>
									<th scope="col" style="width:10%">Action</th>';
							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>".$serialNo."</td>";
								$row['uni_picture'] == null ?
						        $profilePic = '<td><img class="img-circle" width="24" height="24" src="images/uni.jpg"></td>':
						        $profilePic = '<td><img class="img-circle" width="24" height="24" src="'.$row['uni_picture'].'"></td>';
								// $profilePic = '<td><img class="img-circle" width="40" height="40" src="images/uni.jpg"></td>'
        						echo $profilePic;
								echo '<td>'.$row['uni_name'].'</td>';
								echo '<td>'.$row['name'].'</td>';
								echo "<td>
									<a href='createUniversity.php?id=".$row['uni_ID']."' class='sm-primary-btn'>Edit</a>";

								echo '<a href="" class="sm-danger-btn" onclick="confirmDelete('.$row['uni_ID'].', \''.$row['uni_name'].'\')"><i class="fa fa-trash"></i></a>';

								echo "</td>";
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
<script type="text/javascript">
	function confirmDelete(uni_id, uni_name) {
			event.preventDefault();
            let confirmation = confirm("Are you sure you want to delete "+ uni_name +"?");
            if (confirmation == true) {
                window.location.href = "deleteUniversity.php?id="+uni_id;
            	console.log("True");
            }else{
            	console.log("False");
            }
        }
</script>
<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>


