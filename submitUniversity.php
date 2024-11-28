<?php  
if (isset($_POST['submitUni'])) {
	require_once("include/connection.php");
	$name = $_POST['name'];
	$country = $_POST['country'];
	$imagepath = '';

	// if (empty($_FILES['image']['name'])) {
	// 	$imagepath;
	// }else{
	// 	$image = $_FILES['image']['name'];
	// 	$target = "uploads/blogs/";
	// 	$imagepath = $target.time()."-".rand(1000, 9999)."-".$image;	
	// }
	
	
	$sql = "INSERT INTO `tbl_universities`(`uni_name`, `uni_picture`, `country_FK`) VALUES ('$name', '$imagepath', '$country')";

	$result = mysqli_query($conn, $sql);
	if ($result) {
		// if (!empty($_FILES['image']['name'])) {
		// 	move_uploaded_file($_FILES['image']['tmp_name'], $imagepath);
		// }
		header("Location: universities.php?created");
	}else{
		header("Location: universities.php?error");
	}
}elseif (isset($_POST['updateUni'])) {
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
		header("Location: universities.php?updated");
	}else{
		header("Location: universities.php?notUpdated");
	}
}
?>