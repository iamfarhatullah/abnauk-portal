<?php  


if (isset($_POST['submitAllCommissions'])) {
	require_once("include/connection.php");
	$serialNo = $_POST['serialNo'];
	$isCommissionSubmitted = false;
	for ($i=1; $i <= $serialNo; $i++) { 
		$uniID = $_POST['uniID'.$i];

		$sqlPortal = "SELECT * FROM tbl_portals ORDER BY portal_ID";
		$resultPortal = mysqli_query($conn, $sqlPortal);
		if (mysqli_num_rows($resultPortal) > 0) {
			while($rowPortal = mysqli_fetch_assoc($resultPortal)){
				$portalID = $rowPortal['portal_ID'];
				$portalName = $rowPortal['portal_name'];
				$percentage = $_POST[$portalName.$i];

				$checkQuery = "SELECT * FROM tbl_commissions WHERE portal_FK=".$portalID." AND university_FK=".$uniID;
				$checkResult = mysqli_query($conn, $checkQuery);
				if (mysqli_num_rows($checkResult)>0) {
					$updateQuery = "UPDATE `tbl_commissions` SET `commission_percent`='".$percentage."'  WHERE `portal_FK`='".$portalID."' AND `university_FK`='".$uniID."'";
					$updateResult = mysqli_query($conn, $updateQuery);
					if (!$updateResult) {
						header("location: editCommissions.php?error");
					}

				}else{
					$insertQuery = "INSERT INTO `tbl_commissions`(`commission_percent`, `portal_FK`, `university_FK`) VALUES ('$percentage', '$portalID', '$uniID')";
					$insertResult = mysqli_query($conn, $insertQuery);
					if (!$insertResult) {
						header("location: editCommissions.php?error");
					}
				}

			}
			$isCommissionSubmitted = true;
		}
		
	}
	if ($isCommissionSubmitted) {
		header("location: commissions.php?success");		
	}


}else{
	header("location: commissions.php");
}









?>