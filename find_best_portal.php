<?php
include("include/connection.php");

if (isset($_POST['findBestPortal'])) {
    $university = $_POST['university'];
    $sql = "SELECT tbl_commissions.commission_percent, tbl_portals.portal_name
            FROM `tbl_commissions`
            INNER JOIN tbl_portals ON tbl_portals.portal_ID = tbl_commissions.portal_FK
            INNER JOIN tbl_universities ON tbl_universities.uni_ID = tbl_commissions.university_FK
            WHERE tbl_universities.uni_name = '$university'
            ORDER BY tbl_commissions.commission_percent DESC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $flag = '';
        $tempPercent = '';
        $index = 0;
        $commissionList = array();
        while($row = mysqli_fetch_assoc($result)){
            $singleItem = array();
            $commissionPercent = $row['commission_percent'];
            $portalName = $row['portal_name'];
            if ($commissionPercent == 0 || !isset($commissionPercent)) {
                $flag = 'red';
            }elseif($index > 0){
                if($commissionPercent == $tempPercent){
                    $flag = 'green';
                }else{
                    $flag = 'blue';
                }
            }else{
                $flag = 'green';
            }    
            array_push(
                $commissionList, 
                array(
                    'portal_name' => $portalName, 
                    // 'commission_percent' => $commissionPercent,
                    'flag' => $flag
                )
            );
            $tempPercent = $commissionPercent;
            $index++;
        }

        $queryString = http_build_query(array('commissionList' => $commissionList));
        header("location: index.php?".$queryString.'&university='.$university);

        } else {
        header("location: index.php?error&university=".$university);
    }
    
}else{
    header("location: index.php");
}


