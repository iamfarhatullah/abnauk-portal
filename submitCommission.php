<?php  
if (isset($_POST['submitCommission'])) {
	require_once("include/connection.php");
	$portalID = $_POST['portalID'];
	$uniID = $_POST['uniID'];
	$percentage = $_POST['percentage'];	
	
	$sql = "INSERT INTO `tbl_commissions`(`commission_percent`, `portal_FK`, `university_FK`) VALUES ('$percentage', '$portalID', '$uniID')";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		header("Location: commissions.php?created");
	}else{
		header("Location: commissions.php?error");
	}
	
}elseif (isset($_POST['updateCommission'])) {
	require_once("include/connection.php");
	$id = $_POST['uniID'];
	$name = $_POST['name'];
	$country = $_POST['country'];
	
	// $image = $_FILES['image']['name'];
	// $target = "uploads/blogs/";
	// $imagepath = $target.time()."-".rand(1000, 9999)."-".$image;
	
	// $storedImage = $_POST['storedImage'];
    // $image;
    // $finalImage;
    // $newFile = 0;

    // if (empty($_FILES['image']['name'])) {
    //     $finalImage = $storedImage;
    // } else {
    //     $image = $_FILES['image']['name'];
    //     $image = str_replace(' ', '-', $image);
    //     $target = "uploads/blogs/";
    //     $imageNewPath = $target.time()."-".$image;    
    //     $finalImage = $imageNewPath;
    //     $newFile = 1;
    // }
	$finalImage = '';

	$sql = "UPDATE `tbl_universities` SET `uni_name`='".$name."',`country_FK`='".$country."', `uni_picture`='".$finalImage."' WHERE uni_ID='$id'";
	$result = mysqli_query($conn, $sql);
	if ($result) {
		// if ($newFile) {
  //           move_uploaded_file($_FILES['image']['tmp_name'], $imageNewPath);
  //           if (!empty($storedImage)) {
  //           	unlink($storedImage);
  //           }
  //       }
		header("Location: commissions.php?updated");
	}else{
		header("Location: commissions.php?notUpdated");
	}
}
?>