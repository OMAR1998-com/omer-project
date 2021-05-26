<?php
$ParcelID = $_post['ParcelID'];
$Student_Name = $_post['studentname'];
$PhoneCode = $_post['PhoneCode'];
$PhoneNum= $_post['Phone'];

if (!empty($ParcelID ) || !empty($studentname) || !empty($PhoneCode) || !empty($Phone)){
  $host = "localhost";
  $dbUsername = "root";
  $dbPassword = "";
  $dbname = "Collections";

  $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
  if (mysqli_connct_error()) {
    die('Connect Error('. mysqli_connct_error().')'. mysqli_connct_error());
  }else {
    $SELECT = "SELECT ParcelID  From UMP_Parcel Where ParcelID  = ? Limit 1";
    $INSERT = "INSERT Into info (ParcelID, Student_Name, PhoneCode, PhoneNum) values(?,?,?,?)";
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $ParcelID);
    $stmt->execute();
    $stmt->bind_result($ParcelID );
    $stmt->store_result();
    $rnum = $stmt->num_rows;

    if ($rnum==0) {
      $stmt->close();

      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssii", $ParcelID , $Student_Name, $PhoneCode, $PhoneNum);
      $stmt->execute();
      echo "New Record Inserted Sucessfully";
    }else {
      echo "Someone Already Using This Id";
    }
    $stmt->close();
    $conn->close();
  }


}else {
  echo "All field are reqired";
  die();
}
 ?>
