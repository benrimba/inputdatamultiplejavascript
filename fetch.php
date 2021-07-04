<?php
include "koneksi.php";
$request = $_POST['request'];
if($request == 1){
$search = $_POST['search'];
$query = "SELECT * FROM tb_siswa WHERE nis like'%".$search."%'";
$result = $con->query($query);
while($row = mysqli_fetch_array($result) ){
$response[] = array("value"=>$row['nis'],"label"=>$row['nama']);
}
echo json_encode($response);
exit;
}
if($request == 2){
$userid = $_POST['userid'];
$sql = "SELECT * FROM tb_siswa WHERE nis=".$userid;
$result = $con->query($sql);
$users_arr = array();
while( $row = $result->fetch_array() ){
$userid = $row['nis'];
$fullname = $row['nama'];
$users_arr[] = array("nis" => $userid, "nama" => $fullname);
}
echo json_encode($users_arr);
exit;
}
