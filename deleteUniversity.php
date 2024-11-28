<?php  
include("include/connection.php");

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$sql = "DELETE FROM `tbl_universities` WHERE `uni_ID`=$id";

	$result = mysqli_query($conn, $sql);

	if($result){
		header("location: universities.php?deleted");
	}else{
		header("location: universities.php?error");
	}

}else{
	header("location: universities.php?error");
}





?>